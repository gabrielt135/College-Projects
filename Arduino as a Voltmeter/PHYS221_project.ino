
#include <LiquidCrystal.h>
float Vin = 0; //initializing voltage
const int sensorPin = A5; // setting Analog Pin 5 as a desired pin
float R1 = 100000; // 100K Resistor
float R2 = 10000; // 10K Resistor
float Vout = 0;
LiquidCrystal lcd(12, 11, 5, 4, 3, 2);

void setup() {
  // put your setup code here, to run once:
  lcd.begin(16,2);
  lcd.print("Voltage: ");
}

void loop() {
  // put your main code here, to run repeatedly:
  lcd.setCursor(0,1);
  Vout = analogRead(sensorPin) * (5/1024.0);
  Vin = Vout / (R2/(R1+R2));
  
  if (Vout < 0.05)
    Vout = 0.0;
    
  lcd.print(Vout);
  delay(250);
}
