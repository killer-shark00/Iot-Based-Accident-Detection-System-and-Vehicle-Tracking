import numpy as np
import pandas as pd

# Generate synthetic data for a side collision
def generate_side_collision(num_samples):
    # Acceleration in the x-axis increases rapidly based on the side of the hit
    acceleration_x = np.random.normal(10, 2, num_samples)
    acceleration_y = np.random.normal(0, 1, num_samples)
    acceleration_z = np.random.normal(0, 1, num_samples)

    gyroscope_x = np.random.normal(0, 1, num_samples)
    gyroscope_y = np.random.normal(0, 1, num_samples)
    gyroscope_z = np.random.normal(0, 1, num_samples)

    # Create a Pandas DataFrame to store the generated data
    data = pd.DataFrame({
        'acceleration_x': acceleration_x,
        'acceleration_y': acceleration_y,
        'acceleration_z': acceleration_z,
        'gyroscope_x': gyroscope_x,
        'gyroscope_y': gyroscope_y,
        'gyroscope_z': gyroscope_z,
        'label': 1  # Assign label 1 for accident cases
    })

    return data

# Generate synthetic data for a head-on collision
def generate_head_on_collision(num_samples):
    # Acceleration in the z-axis ceases or decelerates rapidly
    acceleration_x = np.random.normal(0, 1, num_samples)
    acceleration_y = np.random.normal(0, 1, num_samples)
    acceleration_z = np.random.normal(-10, 2, num_samples)

    gyroscope_x = np.random.normal(0, 1, num_samples)
    gyroscope_y = np.random.normal(0, 1, num_samples)
    gyroscope_z = np.random.normal(0, 1, num_samples)

    # Create a Pandas DataFrame to store the generated data
    data = pd.DataFrame({
        'acceleration_x': acceleration_x,
        'acceleration_y': acceleration_y,
        'acceleration_z': acceleration_z,
        'gyroscope_x': gyroscope_x,
        'gyroscope_y': gyroscope_y,
        'gyroscope_z': gyroscope_z,
        'label': 1  # Assign label 1 for accident cases
    })

    return data

# Generate synthetic data for a roll-over
def generate_rollover(num_samples):
    # Rapid change in gyroscope readings indicates a roll-over
    acceleration_x = np.random.normal(0, 1, num_samples)
    acceleration_y = np.random.normal(0, 1, num_samples)
    acceleration_z = np.random.normal(0, 1, num_samples)

    gyroscope_x = np.random.normal(0, 2, num_samples)
    gyroscope_y = np.random.normal(0, 2, num_samples)
    gyroscope_z = np.random.normal(10, 2, num_samples)

    # Create a Pandas DataFrame to store the generated data
    data = pd.DataFrame({
        'acceleration_x': acceleration_x,
        'acceleration_y': acceleration_y,
        'acceleration_z': acceleration_z,
        'gyroscope_x': gyroscope_x,
        'gyroscope_y': gyroscope_y,
        'gyroscope_z': gyroscope_z,
        'label': 1  # Assign label 1 for accident cases
    })

    return data

# Generate synthetic data for non-accident cases
def generate_non_accident(num_samples):
    # Generate random data for non-accident cases
    acceleration_x = np.random.normal(0, 1, num_samples)
    acceleration_y = np.random.normal(0, 1, num_samples)
    acceleration_z = np.random.normal(0, 1, num_samples)

    gyroscope_x = np.random.normal(0, 1, num_samples)
    gyroscope_y = np.random.normal(0, 1, num_samples)
    gyroscope_z = np.random.normal(0, 1, num_samples)

    # Create a Pandas DataFrame to store the generated data
    data = pd.DataFrame({
        'acceleration_x': acceleration_x,
        'acceleration_y': acceleration_y,
        'acceleration_z': acceleration_z,
        'gyroscope_x': gyroscope_x,
        'gyroscope_y': gyroscope_y,
        'gyroscope_z': gyroscope_z,
        'label': 0  # Assign label 0 for non-accident cases
    })

    return data

# Generate synthetic dataset for accident detection
def generate_synthetic_dataset(num_samples):
    # Calculate the number of samples for each case (accident and non-accident)
    num_accident_samples = int(num_samples / 2)
    num_non_accident_samples = num_samples - num_accident_samples

    side_collision_data = generate_side_collision(num_accident_samples)
    head_on_collision_data = generate_head_on_collision(num_accident_samples)
    rollover_data = generate_rollover(num_accident_samples)
    non_accident_data = generate_non_accident(num_non_accident_samples)

    # Combine the dataframes for different types of cases
    dataset = pd.concat([side_collision_data, head_on_collision_data, rollover_data, non_accident_data],
                        ignore_index=True)

    return dataset

# Example usage to generate a synthetic dataset with 1000 samples
synthetic_dataset = generate_synthetic_dataset(1000)

# Save the synthetic dataset to a CSV file
synthetic_dataset.to_csv('synthetic_dataset.csv', index=False)
