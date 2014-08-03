package com.flushout.fomonitor.General;

import java.math.BigDecimal;
import java.math.RoundingMode;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;

import com.flushout.fomonitor.Models.DeviceInfo;
import com.flushout.fomonitor.Models.UserInfo;

import android.annotation.SuppressLint;
import android.util.Log;

public class Passwords 
{
	public static boolean validateUnlock(String pass)
	{
		Log.d("FomonitorLog", "Passwords->validateUnlock->begin");
		boolean unlock = false;	
		
		String[] passList = getUnlockList();
		
		for (int i = 0; i < passList.length; i++) {
			Log.d("FomonitorLog", "Passwords->validateUnlock->passList->" + passList[i]);
			if (passList[i].equals(pass)) {
				unlock = true;
			}
		}
		Log.d("FomonitorLog", "Passwords->validateUnlock->end");
		return unlock;
	}
	
	@SuppressLint("SimpleDateFormat")
	private static String[] getUnlockList()
	{
		String[] list = new String[20]; 
		SimpleDateFormat sdf = new SimpleDateFormat("HHmm");

		Calendar cal = Calendar.getInstance();
		cal.setTime(new Date());
		cal.add(Calendar.MINUTE, -10);
		
		String lengthEmail = UserInfo.getUserEmail().length()+"";
		if(lengthEmail.length()==1) lengthEmail = "0"+lengthEmail;
		for (int i = 0; i < list.length; i++) 
		{
			String currentDateTime = sdf.format(cal.getTime());
			String calHours = currentDateTime.substring(0,2);
			if(calHours.length()==1) calHours = "0"+ calHours;
			String calMinute =  currentDateTime.substring(2,4);
			if(calMinute.length()==1) calMinute = "0"+ calMinute;
			Log.d("FomonitorLog", "UnlockActivity->unlockProcess->code->"+calHours + ":"+ calMinute);
			String code = lengthEmail.substring(0, 1) + calMinute.substring(0, 1) + calHours.substring(1, 2) + calMinute.substring(1, 2) + calHours.substring(0, 1) + lengthEmail.substring(1, 2);
			list[i] = code;
			cal.add(Calendar.MINUTE, 1);
		}
		
		/*		String[] list = new String[30]; 
		float imeiFrag = Float.parseFloat(DeviceInfo.getIMEI().substring(12,15));
		Calendar datetime = Calendar.getInstance();
		
		datetime.add(Calendar.MINUTE, -15);
		
		for (int i = 0; i < list.length; i++) 
		{
			String timeTag = new SimpleDateFormat("ddMMhhmm").format(datetime.getTime());
			StringBuffer inverter = new StringBuffer(timeTag);
			float hash = Float.parseFloat(inverter.reverse().toString());
			
			BigDecimal bigd = new BigDecimal(hash/imeiFrag).setScale(8, RoundingMode.FLOOR);
			list[i] = bigd.toString().replace(".", "").substring(0,4);
			datetime.add(Calendar.MINUTE, 1);
		}*/
		
		return list;
	}
	
	public static String getPinHash(String pin, String imei)
	{
		Log.d("Password", "getPinHash 1 --> pin:" + pin + " imei:"+imei);
		if(imei==null) imei="012354654894654654";
		long a = Long.parseLong(imei.substring(0, 6));
		long b = Long.parseLong(imei.substring(6, 12));
		long c = Long.parseLong(imei.substring(12, 15));
		long d = Long.parseLong(pin);
		Log.d("Password", "getPinHash 2");
		long pinhash = (a*d)+b-c;
		Log.d("Password", "getPinHash 3");
		return String.valueOf(pinhash);	
	}
	
	public static String getPin(String pinhash, String imei)
	{
		long a = Long.parseLong(imei.substring(0, 6));
		long b = Long.parseLong(imei.substring(6, 12));
		long c = Long.parseLong(imei.substring(12, 15));
		long p = Long.parseLong(pinhash);
		
		long pin = (p-b+c)/a;
		
		return String.valueOf(pin);	
	}
}
