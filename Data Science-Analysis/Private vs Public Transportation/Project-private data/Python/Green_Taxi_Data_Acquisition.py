import csv

with open("C:\\Users\\Gabriel\\Desktop\\Project-private data\\Python\\green_tripdata_2017-11.csv") as csvfile:
    readCSVN = csv.reader(csvfile,delimiter=',')

    y_data = open('C:\\Users\\Gabriel\\Desktop\\Project-private data\\Green_Taxi_Data_Nov','w')
    
    for row in readCSVN:
        if row:
           y_data.write(row[1] + "," + row[2] + "," + row[8] + '\n')

    y_data.close()

with open("C:\\Users\\Gabriel\\Desktop\\Project-private data\\Python\\green_tripdata_2017-12.csv") as csvfile:
    readCSVD = csv.reader(csvfile,delimiter=',')

    y_data = open('C:\\Users\\Gabriel\\Desktop\\Project-private data\\Green_Taxi_Data_Dec','w')
    
    for row in readCSVD:
        if row:
           y_data.write(row[1] + "," + row[2] + "," + row[8] + '\n')

    y_data.close()

print("DING")
