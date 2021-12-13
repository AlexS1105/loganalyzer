import sys
import json
import matplotlib.pyplot as plt
import pmdarima as pm

series = json.loads(sys.argv[1])

model = pm.auto_arima(list(series.values()), start_p=1, start_q=1,
                      test='adf',       # use adftest to find optimal 'd'
                      max_p=3, max_q=3, # maximum p and q
                      m=1,              # frequency of series
                      d=None,           # let model determine 'd'
                      seasonal=False,   # No Seasonality
                      start_P=0, 
                      D=0, 
                      trace=False,
                      error_action='ignore',  
                      suppress_warnings=True, 
                      stepwise=True)

n_periods = 7
fc, confint = model.predict(n_periods=n_periods, return_conf_int=True)

print(json.dumps(list(fc)))
