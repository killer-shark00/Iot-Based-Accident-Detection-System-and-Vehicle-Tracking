import pandas as pd
from xgboost import XGBClassifier
from sklearn.preprocessing import StandardScaler, LabelEncoder

# Load the trained model and best parameters
best_model = XGBClassifier()
best_model.load_model('best_model.model')

def predict_accidents(file_path):
    predictions = []

    # for file_path in input_files:
        # Read data from CSV file
    data = pd.read_csv(file_path)

    # Extract features from the DataFrame
    features = data[['AccX', 'AccY', 'AccZ', 'GyroX', 'GyroY', 'GyroZ']].values

    # Make predictions using the trained model
    result = best_model.predict(features)
    predictions.append(result)

    return predictions
