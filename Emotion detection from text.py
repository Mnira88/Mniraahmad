#!/usr/bin/env python
# coding: utf-8

# In[1]:


import pandas as pd
import numpy as np
# Matplot
import matplotlib.pyplot as plt
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import LabelEncoder
from sklearn.metrics import confusion_matrix, classification_report, accuracy_score
from sklearn.manifold import TSNE
from sklearn.feature_extraction.text import TfidfVectorizer
from keras.preprocessing.text import Tokenizer

# from keras.preprocessing.sequence import pad_sequences
from keras_preprocessing.sequence import pad_sequences


from keras.models import Sequential
from keras.layers import Activation, Dense, Dropout, Embedding, Flatten, Conv1D, MaxPooling1D, LSTM
from keras import utils
from keras.callbacks import ReduceLROnPlateau, EarlyStopping
import nltk
from nltk.corpus import stopwords
from  nltk.stem import SnowballStemmer
import gensim
import re
import numpy as np
import os
from collections import Counter
import logging
import time
import pickle
import itertools


# In[ ]:


DATASET_COLUMNS = ["target", "ids", "date", "flag", "user", "text"]
DATASET_ENCODING = "ISO-8859-1"
TRAIN_SIZE = 0.8

# TEXT CLENAING
TEXT_CLEANING_RE = "@\S+|https?:\S+|http?:\S|[^A-Za-z0-9]+"

# WORD2VEC 
W2V_SIZE = 300
W2V_WINDOW = 7
W2V_EPOCH = 32
W2V_MIN_COUNT = 10

# KERAS
SEQUENCE_LENGTH = 300
EPOCHS = 8
BATCH_SIZE = 1024

# SENTIMENT
POSITIVE = "POSITIVE"
NEGATIVE = "NEGATIVE"
NEUTRAL = "NEUTRAL"
SENTIMENT_THRESHOLDS = (0.4, 0.7)

# EXPORT
KERAS_MODEL = "model.h5"
WORD2VEC_MODEL = "model.w2v"
TOKENIZER_MODEL = "tokenizer.pkl"
ENCODER_MODEL = "encoder.pkl"


# In[ ]:


df = pd.read_csv('dataset.csv', encoding =DATASET_ENCODING , names=DATASET_COLUMNS)


# In[ ]:


df.head()


# In[ ]:


print("Dataset size:", len(df))


# In[ ]:


from sklearn.utils import shuffle
df = shuffle(df)


# In[ ]:


df = df[0:100000]


# In[ ]:


df.head()


# In[ ]:


df.shape


# In[ ]:


df[df['target']=='NEGATIVE'].count()


# In[ ]:


df[df['target']=='POSITIVE'].count()


# In[ ]:


decode_map = {0: "NEGATIVE", 2: "NEUTRAL", 4: "POSITIVE"}
def decode_sentiment(label):
    return decode_map[int(label)]


# In[ ]:


get_ipython().run_cell_magic('time', '', 'df.target = df.target.apply(lambda x: decode_sentiment(x))\n')


# In[ ]:


target_cnt = Counter(df.target)

plt.figure(figsize=(16,8))
plt.bar(target_cnt.keys(), target_cnt.values())
plt.title("Dataset labels distribuition")


# In[ ]:


stop_words = stopwords.words("english")
stemmer = SnowballStemmer("english")


# In[ ]:


def preprocess(text, stem=False):
    # Remove link,user and special characters
    text = re.sub(TEXT_CLEANING_RE, ' ', str(text).lower()).strip()
    tokens = []
    for token in text.split():
        if token not in stop_words:
            if stem:
                tokens.append(stemmer.stem(token))
            else:
                tokens.append(token)
    return " ".join(tokens)


# In[ ]:


get_ipython().run_cell_magic('time', '', 'df.text = df.text.apply(lambda x: preprocess(x))\n')


# In[ ]:


df_train, df_test = train_test_split(df, test_size=1-TRAIN_SIZE, random_state=42)
print("TRAIN size:", len(df_train))
print("TEST size:", len(df_test))


# In[ ]:


get_ipython().run_cell_magic('time', '', 'documents = [_text.split() for _text in df_train.text] \n')


# In[ ]:


w2v_model = gensim.models.word2vec.Word2Vec(vector_size=W2V_SIZE, 
                                            window=W2V_WINDOW, 
                                            min_count=W2V_MIN_COUNT, 
                                            workers=8)


# In[ ]:


w2v_model.build_vocab(documents)


# In[ ]:


words = list(w2v_model.wv.key_to_index.keys())
vocab_size = len(words)
print("Vocab size:", vocab_size)


# In[ ]:


get_ipython().run_cell_magic('time', '', 'w2v_model.train(documents, total_examples=len(documents), epochs=W2V_EPOCH)\n')


# In[ ]:


similar_words = w2v_model.wv.most_similar("peace")
print(similar_words)


# In[ ]:


get_ipython().run_cell_magic('time', '', 'tokenizer = Tokenizer()\ntokenizer.fit_on_texts(df_train.text)\n\nvocab_size = len(tokenizer.word_index) + 1\nprint("Total words", vocab_size)\n')


# In[ ]:


get_ipython().run_cell_magic('time', '', 'x_train = pad_sequences(tokenizer.texts_to_sequences(df_train.text), maxlen=SEQUENCE_LENGTH)\nx_test = pad_sequences(tokenizer.texts_to_sequences(df_test.text), maxlen=SEQUENCE_LENGTH)\n')


# In[ ]:


labels = df_train.target.unique().tolist()
labels.append(NEUTRAL)
labels


# In[ ]:


encoder = LabelEncoder()
encoder.fit(df_train.target.tolist())

y_train = encoder.transform(df_train.target.tolist())
y_test = encoder.transform(df_test.target.tolist())

y_train = y_train.reshape(-1,1)
y_test = y_test.reshape(-1,1)

print("y_train",y_train.shape)
print("y_test",y_test.shape)


# In[ ]:


print("x_train", x_train.shape)
print("y_train", y_train.shape)
print()
print("x_test", x_test.shape)
print("y_test", y_test.shape)


# In[ ]:


embedding_matrix = np.zeros((vocab_size, W2V_SIZE))
for word, i in tokenizer.word_index.items():
  if word in w2v_model.wv:
    embedding_matrix[i] = w2v_model.wv[word]
print(embedding_matrix.shape)


# In[ ]:


import tensorflow as tf
print(tf.__version__)


# In[ ]:


embedding_layer = Embedding(vocab_size, W2V_SIZE, weights=[embedding_matrix], input_length=SEQUENCE_LENGTH, trainable=False)


# In[ ]:


model = Sequential()
model.add(embedding_layer)
model.add(Dropout(0.5))
model.add(LSTM(100, dropout=0.2, recurrent_dropout=0.2))
model.add(Dense(1, activation='sigmoid'))

model.summary()


# In[ ]:


model.compile(loss='binary_crossentropy',
              optimizer="adam",
              metrics=['accuracy'])


# In[ ]:


callbacks = [ ReduceLROnPlateau(monitor='val_loss', patience=5, cooldown=0),
              EarlyStopping(monitor='val_acc', min_delta=1e-4, patience=5)]


# In[ ]:


get_ipython().run_cell_magic('time', '', 'history = model.fit(x_train, y_train,\n                    batch_size=2048,\n                    epochs=EPOCHS,\n                    validation_split=0.1,\n                    verbose=1,\n                    callbacks=callbacks)\n')


# In[ ]:


get_ipython().run_cell_magic('time', '', 'score = model.evaluate(x_test, y_test, batch_size=2048)\nprint()\nprint("ACCURACY:",score[1])\nprint("LOSS:",score[0])\n')


# In[ ]:


acc = history.history['acc']
val_acc = history.history['val_acc']
loss = history.history['loss']
val_loss = history.history['val_loss']
 
epochs = range(len(acc))
 
plt.plot(epochs, acc, 'b', label='Training acc')
plt.plot(epochs, val_acc, 'r', label='Validation acc')
plt.title('Training and validation accuracy')
plt.legend()
 
plt.figure()
 
plt.plot(epochs, loss, 'b', label='Training loss')
plt.plot(epochs, val_loss, 'r', label='Validation loss')
plt.title('Training and validation loss')
plt.legend()
 
plt.show()


# In[ ]:


def decode_sentiment(score, include_neutral=True):
    if include_neutral:        
        label = NEUTRAL
        if score <= SENTIMENT_THRESHOLDS[0]:
            label = NEGATIVE
        elif score >= SENTIMENT_THRESHOLDS[1]:
            label = POSITIVE

        return label
    else:
        return NEGATIVE if score < 0.5 else POSITIVE


# In[ ]:


def predict(text, include_neutral=True):
    start_at = time.time()
    # Tokenize text
    x_test = pad_sequences(tokenizer.texts_to_sequences([text]), maxlen=SEQUENCE_LENGTH)
    # Predict
    score = model.predict([x_test])[0]
    # Decode sentiment
    label = decode_sentiment(score, include_neutral=include_neutral)

    return {"label": label, "score": float(score),
       "elapsed_time": time.time()-start_at}  


# In[ ]:


predict("I love the music")


# In[ ]:


predict("i don't know what i'm doing")


# In[ ]:


get_ipython().run_cell_magic('time', '', 'y_pred_1d = []\ny_test_1d = list(df_test.target)\nscores = model.predict(x_test, verbose=1, batch_size=8000)\ny_pred_1d = [decode_sentiment(score, include_neutral=False) for score in scores]\n')


# In[ ]:


def plot_confusion_matrix(cm, classes,
                          title='Confusion matrix',
                          cmap=plt.cm.Blues):
    """
    This function prints and plots the confusion matrix.
    Normalization can be applied by setting `normalize=True`.
    """

    cm = cm.astype('float') / cm.sum(axis=1)[:, np.newaxis]

    plt.imshow(cm, interpolation='nearest', cmap=cmap)
    plt.title(title, fontsize=30)
    plt.colorbar()
    tick_marks = np.arange(len(classes))
    plt.xticks(tick_marks, classes, rotation=90, fontsize=22)
    plt.yticks(tick_marks, classes, fontsize=22)

    fmt = '.2f'
    thresh = cm.max() / 2.
    for i, j in itertools.product(range(cm.shape[0]), range(cm.shape[1])):
        plt.text(j, i, format(cm[i, j], fmt),
                 horizontalalignment="center",
                 color="white" if cm[i, j] > thresh else "black")

    plt.ylabel('True label', fontsize=25)
    plt.xlabel('Predicted label', fontsize=25)


# In[ ]:


get_ipython().run_cell_magic('time', '', '\ncnf_matrix = confusion_matrix(y_test_1d, y_pred_1d)\nplt.figure(figsize=(12,12))\nplot_confusion_matrix(cnf_matrix, classes=df_train.target.unique(), title="Confusion matrix")\nplt.show()\n')


# In[ ]:


print(classification_report(y_test_1d, y_pred_1d))


# In[ ]:


model.save(KERAS_MODEL)
w2v_model.save(WORD2VEC_MODEL)
pickle.dump(tokenizer, open(TOKENIZER_MODEL, "wb"), protocol=0)
pickle.dump(encoder, open(ENCODER_MODEL, "wb"), protocol=0)


# In[ ]:


accuracy_score(y_test_1d, y_pred_1d)


# In[ ]:





# In[ ]:





# In[ ]:





# In[ ]:





# In[ ]:




