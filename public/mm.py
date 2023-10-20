import pandas as pd

# Read the CSV file
data = pd.read_csv('Vehicle3.csv')

# Extract the timestamps from the first column
timestamps = data.iloc[:, -1].tolist()

# Convert timestamps to datetime format
datetime_values = pd.to_datetime(timestamps, unit='ms')

# Extract date and time separately
dates = datetime_values.date
times = datetime_values.time

# Add date and time columns to the DataFrame
data['Date'] = dates
data['Time'] = times

# Remove the timestamp column
data = data.iloc[:, 1:]

# Save the DataFrame back to the CSV file
data.to_csv('Vehicle3.csv', index=False)
