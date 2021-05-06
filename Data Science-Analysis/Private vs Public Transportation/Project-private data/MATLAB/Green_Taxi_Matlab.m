%Opening the file and extracting the data but separating the header from
%the needed data and then closing it
fid = fopen('C:\\Users\\Gabriel\\Desktop\\Project-private data\\Green_Taxi_Data_Nov');
readHeader = textscan(fid,'%s %s %s',1,'HeaderLines',0,'Delimiter',',');
readData = textscan(fid,'%s %s %f','Delimiter',',');
fclose(fid);

%Grabbing the data from readData
Pick_up_time = readData{1};
Drop_off_time = readData{2};
Distance = readData{3};

%formatting and converting the dates into a time vector
Formatted_Pick_Up_Time = datetime(Pick_up_time,'InputFormat','yyyy-MM-dd HH:mm:ss');
Formatted_Drop_Off_Time = datetime(Drop_off_time,'InputFormat','yyyy-MM-dd HH:mm:ss');
True_Pick_Up_Time = datevec(Formatted_Pick_Up_Time);
True_Drop_Off_Time = datevec(Formatted_Drop_Off_Time);

%Converting time to elapsed time in seconds
Elapsed_Time = etime(True_Drop_Off_Time,True_Pick_Up_Time);

%creating a new vector array for the formatted time 
Formatted_Data = [Elapsed_Time,Distance];

five_miles = zeros(874173,2);
ten_miles = zeros(874173,2);
twenty_miles = zeros(874173,2);

for idx = 1:1:size(Distance,1)
    if Distance(idx) <= 5.0
        five_miles(idx,:) = Formatted_Data(idx,:);
    end
end

for idx = 1:1:size(Distance,1)
     if Distance(idx) > 5.0 && Distance(idx) <= 10.0 
        ten_miles(idx,:) = Formatted_Data(idx,:);
     end
end

for idx = 1:1:size(Distance,1)
     if Distance(idx) > 10 && Distance(idx) <= 20.0
        twenty_miles(idx,:) = Formatted_Data(idx,:);
     end
end

copy_five = five_miles(any(five_miles,2),:);
copy_ten = ten_miles(any(ten_miles,2),:);
copy_twenty = twenty_miles(any(twenty_miles,2),:);

figure(1)
scatter(copy_five(:,1) ./ 3600,copy_five(:,2));
figure(2)
scatter(copy_ten(:,1) ./ 3600,copy_ten(:,2));
figure(3)
scatter(copy_twenty(:,1) ./ 3600,copy_twenty(:,2));