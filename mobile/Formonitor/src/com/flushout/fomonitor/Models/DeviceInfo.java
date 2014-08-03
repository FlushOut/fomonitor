package com.flushout.fomonitor.Models;

import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.IntentFilter;
import android.net.TrafficStats;
import android.os.Build;
import android.provider.Settings;
import android.telephony.PhoneStateListener;
import android.telephony.SignalStrength;
import android.telephony.TelephonyManager;

import com.flushout.fomonitor.MainActivity; //com.flushout.fomonitor.MainActivity;
import com.flushout.fomonitor.R;
import com.flushout.fomonitor.General.General;

public class DeviceInfo 
{
	private static String signalStrength = "99";
	
	public static String getIMEI()
	{
		if (null!=General.getAppContext())
		{
			TelephonyManager telephonyManager = (TelephonyManager) General.getAppContext().getSystemService(Context.TELEPHONY_SERVICE);
			String imei = telephonyManager.getDeviceId();
			
			// For emulators
			if ("000000000000000".equals(imei)) imei = "123456789012345";
			
			return imei;
		}
		
		return null;
	}
	
	public static String getModel()
	{
		String manufacturer = Build.MANUFACTURER;
		String model = Build.MODEL;
		if (model.startsWith(manufacturer))
			return General.capitalize(model);
		else
			return General.capitalize(manufacturer) + " " + model;
	}
	
	public static String getManufacturer()
	{
		String manufacturer = Build.MANUFACTURER;
		return General.capitalize(manufacturer);
	}
	
	public static String getBatteryLevel()
	{
		Intent batteryIntent = General.getAppContext().getApplicationContext().registerReceiver(null, new IntentFilter(Intent.ACTION_BATTERY_CHANGED));
		int rawlevel = batteryIntent.getIntExtra("level", -1);
		double scale = batteryIntent.getIntExtra("scale", -1);
		double level = -1;
		
		if (rawlevel >= 0 && scale > 0)
			level = rawlevel / scale;
	
		return String.valueOf(level);
	}
	
	public static String getPhoneNumber()
	{
		TelephonyManager manager = (TelephonyManager)General.getAppContext().getSystemService(Context.TELEPHONY_SERVICE);
		String phoneNumber = manager.getLine1Number();
			
		return phoneNumber;
	}
	
	public static void setGSMStrenth(String str)
	{
		signalStrength = str;
	}
	
	public static String getGSMStrength()
	{
		TelephonyManager telephonyManager = (TelephonyManager)General.getAppContext().getSystemService(Context.TELEPHONY_SERVICE);
		PhoneListener phoneListener = new PhoneListener();
		telephonyManager.listen(phoneListener, PhoneStateListener.LISTEN_SIGNAL_STRENGTHS);
		
		return signalStrength;
	}
	
	public static String getCarrier()
	{
		TelephonyManager manager = (TelephonyManager)General.getAppContext().getSystemService(Context.TELEPHONY_SERVICE);
		String carrierName = manager.getNetworkOperatorName();
		
		return carrierName;
	}
	
	public static void forceGPS()
	{
		Context ctx = General.getAppContext();
		String provider = Settings.Secure.getString(ctx.getContentResolver(), Settings.Secure.LOCATION_PROVIDERS_ALLOWED);
		
		if(provider.contains("gps") == true) 
		{
			return;
		}

		AlertDialog.Builder alertDialog = new AlertDialog.Builder(MainActivity.getInstance().getActivityContext());
	   
    	alertDialog.setTitle(ctx.getString(R.string.gps_disabled));
    	alertDialog.setMessage(ctx.getString(R.string.gps_need_to_be_enabled));
    
    	alertDialog.setPositiveButton(ctx.getString(R.string.enable), new DialogInterface.OnClickListener() 
    	{
			@Override
			public void onClick(DialogInterface dialog, int which) 
			{
				Intent intent = new Intent(Settings.ACTION_LOCATION_SOURCE_SETTINGS);
				intent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
				General.getAppContext().startActivity(intent);
			}
		});
   
    	alertDialog.create().show();
	}
	
	public static long getReceivedBytes()
	{
		return TrafficStats.getTotalRxBytes();
	}
	
	public static long getTransmittedBytes()
	{
		return TrafficStats.getTotalTxBytes();
	}
	
	
	private static class PhoneListener extends PhoneStateListener
	{
	      @Override
	      public void onSignalStrengthsChanged(SignalStrength signalStrength)
	      {
	         super.onSignalStrengthsChanged(signalStrength);
	         DeviceInfo.setGSMStrenth(String.valueOf(signalStrength.getGsmSignalStrength()));
	      }	     
	 };
}
