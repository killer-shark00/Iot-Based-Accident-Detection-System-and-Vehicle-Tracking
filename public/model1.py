# import pandas as pd
# from sklearn.model_selection import train_test_split
# from sklearn.preprocessing import StandardScaler, LabelEncoder
# from keras.models import Sequential
# from keras.layers import Dense
# from keras.metrics import Precision, Recall, AUC

# # Load the dataset that includes accelerometer, gyroscope data
# data = pd.read_csv('synthetic_data.csv')

# # Separate the features (accelerometer, gyroscope) from the target variable (accident label)
# X = data[['acc_X', 'acc_Y', 'acc_Z', 'gyro_X', 'gyro_Y', 'gyro_Z']]
# y = data['Label']

# # Encode the target variable
# label_encoder = LabelEncoder()
# y = label_encoder.fit_transform(y)

# # Split the dataset into training and testing sets
# X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# # Standardize the features
# scaler = StandardScaler()
# X_train_scaled = scaler.fit_transform(X_train)
# X_test_scaled = scaler.transform(X_test)

# # Build the deep learning model
# model = Sequential()
# model.add(Dense(64, activation='relu', input_shape=(6,)))
# model.add(Dense(64, activation='relu'))
# model.add(Dense(1, activation='sigmoid'))

# # Compile the model
# model.compile(optimizer='adam',
#               loss='binary_crossentropy',
#               metrics=[Precision(), Recall(), AUC()])

# # Train the model
# model.fit(X_train_scaled, y_train, epochs=10, batch_size=32, verbose=1)

# # Evaluate the model on the test set
# _, precision, recall, auc = model.evaluate(X_test_scaled, y_test)

# print("Precision:", precision)
# print("Recall:", recall)
# print("AUC:", auc)






# import pandas as pd
# import numpy as np
# from sklearn.tree import DecisionTreeClassifier
# from sklearn.model_selection import train_test_split
# from sklearn.preprocessing import StandardScaler, LabelEncoder
# from sklearn.metrics import accuracy_score, precision_score, recall_score, roc_auc_score, confusion_matrix

# # Read data from CSV file
# data = pd.read_csv('synthetic_data.csv')

# # Extract features and labels from the DataFrame
# features = data[['acc_X', 'acc_Y', 'acc_Z', 'gyro_X', 'gyro_Y', 'gyro_Z']].values
# labels = data['Label']

# # Encode the target variable
# label_encoder = LabelEncoder()
# y = label_encoder.fit_transform(labels)

# # Split data into training and testing sets
# X_train, X_test, y_train, y_test = train_test_split(features, y, test_size=0.2, random_state=42)

# # Train the decision tree classifier
# classifier = DecisionTreeClassifier()
# classifier.fit(X_train, y_train)

# # Make predictions on the test set
# predictions = classifier.predict(X_test)

# # Calculate accuracy of the model
# accuracy = accuracy_score(y_test, predictions)
# print("Accuracy:", accuracy)

# # Calculate precision, recall, and AUC
# precision = precision_score(y_test, predictions)
# recall = recall_score(y_test, predictions)
# auc = roc_auc_score(y_test, predictions)
# print("Precision:", precision)
# print("Recall:", recall)
# print("AUC:", auc)

# # Calculate confusion matrix
# confusion_mat = confusion_matrix(y_test, predictions)
# print("Confusion Matrix:")
# print(confusion_mat)




# import pandas as pd
# from sklearn.preprocessing import StandardScaler, LabelEncoder
# import numpy as np
# from sklearn.model_selection import train_test_split
# from sklearn.metrics import accuracy_score, precision_score, recall_score, roc_auc_score, confusion_matrix
# import xgboost as xgb

# # Read data from CSV file
# data = pd.read_csv('synthetic_data.csv')

# # Extract features and labels from the DataFrame
# X = data[['acc_X', 'acc_Y', 'acc_Z', 'gyro_X', 'gyro_Y', 'gyro_Z']].values
# y = data['Label'].values

# # Encode the target variable
# label_encoder = LabelEncoder()
# y = label_encoder.fit_transform(y)

# # Split data into training and testing sets
# X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# # Create XGBoost classifier
# classifier = xgb.XGBClassifier()

# # Train the classifier
# classifier.fit(X_train, y_train)

# # Make predictions on the test set
# y_pred = classifier.predict(X_test)

# # Calculate evaluation metrics
# accuracy = accuracy_score(y_test, y_pred)
# precision = precision_score(y_test, y_pred)
# recall = recall_score(y_test, y_pred)
# auc = roc_auc_score(y_test, y_pred)
# confusion_mat = confusion_matrix(y_test, y_pred)

# # Print the evaluation metrics
# print("Accuracy:", accuracy)
# print("Precision:", precision)
# print("Recall:", recall)
# print("AUC:", auc)
# print("Confusion Matrix:")
# print(confusion_mat)




# import pandas as pd
# import numpy as np
# import xgboost as xgb
# from sklearn.preprocessing import StandardScaler, LabelEncoder
# from sklearn.model_selection import train_test_split, GridSearchCV
# from sklearn.metrics import accuracy_score, precision_score, recall_score, roc_auc_score, confusion_matrix
# from imblearn.over_sampling import RandomOverSampler
# from imblearn.under_sampling import RandomUnderSampler
# import matplotlib.pyplot as plt

# # Read data from CSV file
# data = pd.read_csv('synthetic_data.csv')

# # Extract features and labels from the DataFrame
# features = data[['acc_X', 'acc_Y', 'acc_Z', 'gyro_X', 'gyro_Y', 'gyro_Z']].values
# labels = data['Label']

# # # Encode the target variable
# label_encoder = LabelEncoder()
# y = label_encoder.fit_transform(labels)

# # Split data into training and testing sets
# X_train, X_test, y_train, y_test = train_test_split(features, y, test_size=0.2, random_state=42)

# # Handle class imbalance
# # Oversampling the minority class
# oversampler = RandomOverSampler(random_state=42)
# X_train, y_train = oversampler.fit_resample(X_train, y_train)

# # Undersampling the majority class
# # undersampler = RandomUnderSampler(random_state=42)
# # X_train, y_train = undersampler.fit_resample(X_train, y_train)

# # Train the XGBoost classifier
# model = xgb.XGBClassifier(random_state=42)

# # Hyperparameter tuning using GridSearchCV
# param_grid = {
#     'learning_rate': [0.1, 0.01, 0.001],
#     'max_depth': [3, 5, 7],
#     'n_estimators': [100, 200, 300]
# }

# grid_search = GridSearchCV(model, param_grid, cv=5, scoring='accuracy')
# grid_search.fit(X_train, y_train)

# best_model = grid_search.best_estimator_

# # Make predictions on the test set
# predictions = best_model.predict(X_test)

# # Calculate evaluation metrics
# accuracy = accuracy_score(y_test, predictions)
# precision = precision_score(y_test, predictions)
# recall = recall_score(y_test, predictions)
# auc = roc_auc_score(y_test, predictions)
# confusion_mat = confusion_matrix(y_test, predictions)

# # Print evaluation metrics
# print("Accuracy:", accuracy)
# print("Precision:", precision)
# print("Recall:", recall)
# print("AUC:", auc)
# print("Confusion Matrix:")
# print(confusion_mat)

# # Plot feature importance
# feature_importance = best_model.feature_importances_
# feature_names = ['acc_X', 'acc_Y', 'acc_Z', 'gyro_X', 'gyro_Y', 'gyro_Z']
# sorted_indices = np.argsort(feature_importance)

# plt.barh(range(len(feature_names)), feature_importance[sorted_indices])
# plt.yticks(range(len(feature_names)), [feature_names[i] for i in sorted_indices])
# plt.xlabel('Feature Importance')
# plt.ylabel('Feature')
# plt.show()


import pandas as pd
import numpy as np
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import StandardScaler, LabelEncoder
from sklearn.metrics import accuracy_score, precision_score, recall_score, f1_score, confusion_matrix
from xgboost import XGBClassifier
from sklearn.model_selection import GridSearchCV
import matplotlib.pyplot as plt
import seaborn as sns

# Read data from CSV file
data = pd.read_csv('synthetic_dataset.csv')

# Extract features and labels from the DataFrame
features = data[['acc_X', 'acc_Y', 'acc_Z', 'gyro_X', 'gyro_Y', 'gyro_Z']].values
labels = data['Label']

# Encode the target variable
label_encoder = LabelEncoder()
y = label_encoder.fit_transform(labels)

# Split data into training, validation, and testing sets
X_train, X_test, y_train, y_test = train_test_split(features, y, test_size=0.2, random_state=42)
X_train, X_val, y_train, y_val = train_test_split(X_train, y_train, test_size=0.25, random_state=42)  # 60% train, 20% validation, 20% test

# Define the XGBoost classifier
classifier = XGBClassifier()

# Define the hyperparameters to tune
param_grid = {
    'max_depth': [3, 4, 5],
    'learning_rate': [0.1, 0.01, 0.001],
    'n_estimators': [100, 500, 1000],
    'gamma': [0, 0.1, 0.2],
    'subsample': [0.8, 1.0],
    'colsample_bytree': [0.8, 1.0]
}

# Perform grid search cross-validation to find the best hyperparameters
grid_search = GridSearchCV(classifier, param_grid=param_grid, scoring='accuracy', cv=5)
grid_search.fit(X_train, y_train)

# Get the best hyperparameters and the corresponding model
best_params = grid_search.best_params_
best_model = grid_search.best_estimator_

# Train the model with the best hyperparameters
best_model.fit(X_train, y_train)


# Save the best model
best_model.save_model('best_model.model')

# Make predictions on the validation set using the best model
val_predictions = best_model.predict(X_val)

# Calculate evaluation metrics for the validation set
val_accuracy = accuracy_score(y_val, val_predictions)
val_precision = precision_score(y_val, val_predictions)
val_recall = recall_score(y_val, val_predictions)
val_f1 = f1_score(y_val, val_predictions)
val_conf_matrix = confusion_matrix(y_val, val_predictions)

# Make predictions on the test set using the best model
test_predictions = best_model.predict(X_test)

# Calculate evaluation metrics for the test set
test_accuracy = accuracy_score(y_test, test_predictions)
test_precision = precision_score(y_test, test_predictions)
test_recall = recall_score(y_test, test_predictions)
test_f1 = f1_score(y_test, test_predictions)
test_conf_matrix = confusion_matrix(y_test, test_predictions)

# Print the evaluation metrics for validation and test sets
print("Validation Set Metrics:")
print("Accuracy:", val_accuracy)
print("Precision:", val_precision)
print("Recall:", val_recall)
print("F1-score:", val_f1)
print("Confusion Matrix:")
print(val_conf_matrix)


print("\nTest Set Metrics:")
print("Accuracy:", test_accuracy)
print("Precision:", test_precision)
print("Recall:", test_recall)
print("F1-score:", test_f1)
print("Confusion Matrix:")
print(test_conf_matrix)

# # Create a bar plot for the evaluation metrics
# metrics = ['Accuracy', 'Precision', 'Recall', 'F1-score']
# validation_scores = [val_accuracy, val_precision, val_recall, val_f1]
# test_scores = [test_accuracy, test_precision, test_recall, test_f1]

# plt.figure(figsize=(10, 6))
# plt.bar(metrics, validation_scores, label='Validation Set', alpha=0.8)
# plt.bar(metrics, test_scores, label='Test Set', alpha=0.6)
# plt.xlabel('Metrics')
# plt.ylabel('Scores')
# plt.title('Evaluation Metrics - Validation vs Test')
# plt.legend()
# plt.show()

# Create a heatmap for the confusion matrix of the test set
plt.figure(figsize=(8, 6))
sns.heatmap(test_conf_matrix, annot=True, cmap='Blues', fmt='d', cbar=False)
plt.xlabel('Predicted Labels')
plt.ylabel('True Labels')
plt.title('Confusion Matrix - Test Set')
plt.show()

# import matplotlib.pyplot as plt

# # Define the evaluation metrics
# metrics = ['Accuracy', 'Precision', 'Recall', 'F1-score']
# validation_scores = [val_accuracy, val_precision, val_recall, val_f1]
# test_scores = [test_accuracy, test_precision, test_recall, test_f1]

# # Plot the evaluation metrics
# plt.figure(figsize=(10, 6))
# plt.plot(metrics, validation_scores, marker='o', label='Validation Set')
# plt.plot(metrics, test_scores, marker='o', label='Test Set')
# plt.xlabel('Metrics')
# plt.ylabel('Scores')
# plt.title('Evaluation Metrics - Validation Set vs Test Set')
# plt.legend()
# plt.grid(True)
# plt.show()



# import pandas as pd
# import numpy as np
# from sklearn.model_selection import train_test_split
# from sklearn.preprocessing import StandardScaler, LabelEncoder
# from sklearn.metrics import accuracy_score, precision_score, recall_score, f1_score, confusion_matrix
# from xgboost import XGBClassifier
# from sklearn.model_selection import GridSearchCV

# # Read data from CSV file
# data = pd.read_csv('synthetic_data.csv')

# # Extract features and labels from the DataFrame
# features = data[['acc_X', 'acc_Y', 'acc_Z', 'gyro_X', 'gyro_Y', 'gyro_Z']].values
# labels = data['Label']

# # # # Encode the target variable
# label_encoder = LabelEncoder()
# y = label_encoder.fit_transform(labels)

# # Split data into training and testing sets
# X_train, X_test, y_train, y_test = train_test_split(features, y, test_size=0.2, random_state=42)

# # Define the XGBoost classifier
# classifier = XGBClassifier()

# # Define the hyperparameters to tune
# param_grid = {
#     'max_depth': [3, 4, 5, 6],
#     'learning_rate': [0.1, 0.01, 0.001],
#     'n_estimators': [100, 500, 1000],
#     'gamma': [0, 0.1, 0.2, 0.3],
#     'subsample': [0.8, 1.0],
#     'colsample_bytree': [0.8, 1.0],
#     'reg_alpha': [0, 0.1, 0.5],
#     'reg_lambda': [0, 0.1, 0.5]
# }

# # Perform grid search cross-validation to find the best hyperparameters
# grid_search = GridSearchCV(classifier, param_grid=param_grid, scoring='accuracy', cv=10)
# grid_search.fit(X_train, y_train)

# # Get the best hyperparameters and the corresponding model
# best_params = grid_search.best_params_
# best_model = grid_search.best_estimator_

# # Train the model with the best hyperparameters
# best_model.fit(X_train, y_train)

# # Make predictions on the test set using the best model
# predictions = best_model.predict(X_test)

# # Calculate evaluation metrics
# accuracy = accuracy_score(y_test, predictions)
# precision = precision_score(y_test, predictions)
# recall = recall_score(y_test, predictions)
# f1 = f1_score(y_test, predictions)
# conf_matrix = confusion_matrix(y_test, predictions)

# # Print the evaluation metrics
# print("Accuracy:", accuracy)
# print("Precision:", precision)
# print("Recall:", recall)
# print("F1-score:", f1)
# print("Confusion Matrix:")
# print(conf_matrix)













































# Worst 
# import pandas as pd
# from sklearn.ensemble import RandomForestClassifier
# from sklearn.model_selection import train_test_split
# from sklearn.metrics import accuracy_score, precision_score, recall_score, f1_score, confusion_matrix

# # Load data from CSV file
# data = pd.read_csv('synthetic_data.csv')

# # Separate features (accelerometer and gyroscope readings) and labels
# X = data.iloc[:, :-1]  # Features (all columns except the last one)
# y = data.iloc[:, -1]   # Labels (last column)

# # Split the data into training and testing sets
# X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# # Initialize a Random Forest classifier
# clf = RandomForestClassifier(n_estimators=100, random_state=42)

# # Train the classifier
# clf.fit(X_train, y_train)

# # Make predictions on the test set
# y_pred = clf.predict(X_test)

# # Calculate accuracy of the classifier
# accuracy = accuracy_score(y_test, y_pred)
# print("Accuracy:", accuracy)

# # Calculate precision, recall, and F1-score
# precision = precision_score(y_test, y_pred, pos_label='Accident')
# recall = recall_score(y_test, y_pred, pos_label='Accident')
# f1 = f1_score(y_test, y_pred, pos_label='Accident')
# print("Precision:", precision)
# print("Recall:", recall)
# print("F1-score:", f1)

# # Calculate and print the confusion matrix
# confusion_mat = confusion_matrix(y_test, y_pred, labels=['Normal', 'Accident'])
# print("Confusion Matrix:")
# print(confusion_mat)


