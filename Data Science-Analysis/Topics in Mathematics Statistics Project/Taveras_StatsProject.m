% reading the MCAT Data
%Note: The MCATData table was slighlty modified in order to read the Total
%MCAT variable
MCATData = readtable('MCATData_StatsProject.xlsx','ReadRowNames',true);
format compact;

%initializing vectors with information found on past MCAT scaled scores and
%standard deviations
Avg_MCAT_06_11 = [25.1;25.1;24.9;25.1;25.0;25.1];
StDev_MCAT_06_11 =[6.5;6.4;6.4;6.5;6.4;6.4];

%true means of the past MCAT scaled scores and standard deviations
true_mean_Avg_MCAT_06_11 = mean(Avg_MCAT_06_11)
true_mean_StDev_MCAT_06_11 = mean(StDev_MCAT_06_11)

%mean and standard deviations of the MCAT data table's TOtal MCAT vector
mean_MCATData = mean(MCATData.TotalMCAT)
StDev_MCATData = std(MCATData.TotalMCAT)

%Mean and Standaerd Deviation of the MCAT Data table's Total SAT variable
fprintf("\n");
mean_SAT = mean(MCATData.TotalSATScoreV_M)
StDev_SAT = std(MCATData.TotalSATScoreV_M)

%Making the Total SAT variable a special categorical variable inorder to
%use the < or > comparators
valueset = [min(MCATData.TotalSATScoreV_M):max(MCATData.TotalSATScoreV_M)];
SAT = categorical(MCATData.TotalSATScoreV_M,valueset,'Ordinal',true);

%Extracting variable vectors from the Data table in order to creat the
%Groups L and H
MCATBS = MCATData.MCATBS;
MCATPS = MCATData.MCATPS;
MCATVR = MCATData.MCATVR;
MCATTotal = MCATData.TotalMCAT;
MCATSAT = MCATData.TotalSATScoreV_M;
MCATSATVer = MCATData.SATVerbal;
MCATSATMath = MCATData.SATMath;

%Creating Group L matrix where the students' SAT scores were less than 1288
GroupL = [MCATTotal(SAT < '1288'),MCATBS(SAT < '1288'),MCATPS(SAT < '1288'),...
    MCATVR(SAT < '1288'),MCATSAT(SAT < '1288'),MCATSATVer(SAT < '1288'),...
    MCATSATMath(SAT < '1288')];

%Creating Group H matrix where the students' SAT scores were greater than
%1288
GroupH = [MCATTotal(SAT > '1288'),MCATBS(SAT > '1288'),MCATPS(SAT > '1288'),...
    MCATVR(SAT > '1288'),MCATSAT(SAT > '1288'),MCATSATVer(SAT > '1288'),...
    MCATSATMath(SAT > '1288')];

%Side-by-Side boxplot of Group L and Group H's MCAT scores
bp(:,1) = GroupL(:,1);
bp(size(bp,1)+1:size(GroupH,1),1) = 0;
bp(:,2) = GroupH(:,1);
boxplot(bp(:,1:2),'orientation','horizontal');
title('MCAT scores; Group L vs. Group H');

%Creating a vector where the Group L's students have MCAT scores between 25
%and 29
for i = 1:size(GroupL,1)
    if(GroupL(i,1) >= 25)
        MCAT_StudentL(i,1) = GroupL(i,1);
    end
end

%getting rid of the zeros in the vector
MCAT_StudentL(MCAT_StudentL == 0) = [];

%Creating a vector where the Group H's students have MCAT scores between 25
%and 29
for i = 1:size(GroupH,1)
    if(GroupH(i,1) >= 25)
        MCAT_StudentH(i,1) = GroupH(i,1);
    end
end

%getting rid of the zeros in the vector
MCAT_StudentH(MCAT_StudentH == 0) = [];


fprintf("\n Group Proportions and Confidence Interval: \n");

%The percentage Proportions from both Groups
GroupL_Proportion = size(MCAT_StudentL,1) / size(GroupL,1)
GroupH_Proportion = size(MCAT_StudentH,1) / size(GroupH,1)

%Confidence Interval calculation for Group L
MCAT_StudentL_Mean = mean(MCAT_StudentL(:,1));
MCAT_StudentL_StDev = std(MCAT_StudentL(:,1));
Mult99L = tinv(0.005,size(MCAT_StudentL,1)-1);
ME99L = abs(Mult99L)*MCAT_StudentL_StDev/sqrt(size(MCAT_StudentL,1));
top99L = MCAT_StudentL_Mean + ME99L
bottom99L = MCAT_StudentL_Mean - ME99L

%Confidence Interval Calculation for Group H
MCAT_StudentH_Mean = mean(MCAT_StudentH(:,1));
MCAT_StudentH_StDev = std(MCAT_StudentH(:,1));
Mult99H = tinv(0.005,size(MCAT_StudentH,1)-1);
ME99H = abs(Mult99H)*MCAT_StudentH_StDev/sqrt(size(MCAT_StudentH,1));
top99H = MCAT_StudentH_Mean + ME99H
bottom99H = MCAT_StudentH_Mean - ME99H

fprintf("\n Confidence Interval for the difference in means between Group L and Group H \n");

%Confidence Interval Calculation for the difference of Group L and Group
%H's MCAT scores
tempGroupL = MCAT_StudentL;
tempGroupL(size(tempGroupL,1)+1:size(MCAT_StudentH,1),1) = 0;
diff_Group = abs(tempGroupL(:,1) - MCAT_StudentH(:,1));
diff_Group_Mean = mean(diff_Group);
diff_Group_StDev = std(diff_Group);
Mult90D = tinv(0.05,size(diff_Group,1)-1);
ME90D = abs(Mult90D)*MCAT_StudentL_StDev/sqrt(size(diff_Group,1));
top90D = diff_Group_Mean + ME90D
bottom90D = diff_Group_Mean - ME90D

fprintf("\n Hypothesis test for Means of MCAT scores from Group L and Group H \n");

%Hypothesis test in order to see if there is a significant difference
%between the mean of Group L's MCAT scores and the mean of Group H's MCAT
%scores
mean_GroupL_MCAT = mean(GroupL(:,1));
mean_GroupH_MCAT = mean(GroupH(:,1));
[Group_bool,Group_Pvalue] = ttest2(mean_GroupL_MCAT,mean_GroupH_MCAT,'Tail','left','Vartype','unequal')
[Group_bool,Group_Pvalue] = ttest2(mean_GroupL_MCAT,mean_GroupH_MCAT,'Tail','right','Vartype','unequal')
[Group_bool,Group_Pvalue] = ttest2(mean_GroupL_MCAT,mean_GroupH_MCAT,'Tail','both','Vartype','unequal')

fprintf("\n Linear Regression Table and Scatter Plot for Total SAT scores vs. Total MCAT scores \n");
%Scatter Plot of Total MCAT scores vs. Total SAT scores
figure();
scatter(MCATTotal,MCATSAT,'d','filled');
lsline %best fit line
title("Total MCAT scores vs. Total SAT scores");

%Linear Regression Model
MCATvSATModel = fitlm(MCATData,'TotalMCAT ~ TotalSATScoreV_M')
MCATwSAT = [MCATTotal,MCATSAT];

%Correlation Coefficient
corr_coeff1 = rank(MCATwSAT)

fprintf("\n Linear Regression Table and Scatter Plot for unique SAT scores and means of MCAT scores in relation to the unique SAT scores \n")

%block to calculate the mean MCAT scores that have the same SAT scores
Achieved_SAT_Score = unique(MCATSAT);
for i = 1:size(Achieved_SAT_Score,1)
    mean_MCAT_score(i,1) = mean(MCATData.TotalMCAT(SAT == num2str(Achieved_SAT_Score(i,1))));
end

%Scatter Plot of relative mean MCAT scores and unique SAT scores
figure();
scatter(mean_MCAT_score,Achieved_SAT_Score,'d','filled');
lsline %best fit line
title("meaned MCAT scores vs. unique SAT scores");

%correlation Coefficient
corr_coeff2 = rank([mean_MCAT_score,Achieved_SAT_Score]);

%creating a table in order to do a Linear Regression model on the relative 
%mean MCAT scores and unique SAT scores.
Achieved_and_Mean_Table = table(mean_MCAT_score,Achieved_SAT_Score,'VariableNames',{'Unique_Mean_MCAT_Scores','Unique_SAT_Scores'});

%Linear Regression Model of the relative mean MCAT scores and unique SAT scores
AchievedvMeanModel = fitlm(Achieved_and_Mean_Table,'Unique_Mean_MCAT_Scores ~ Unique_SAT_Scores')