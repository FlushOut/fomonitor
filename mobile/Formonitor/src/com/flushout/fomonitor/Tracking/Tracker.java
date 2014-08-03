package com.flushout.fomonitor.Tracking;

import java.io.BufferedWriter;
import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.text.SimpleDateFormat;
import java.util.Date;

import android.annotation.SuppressLint;
import android.app.Service;
import android.content.Context;
import android.content.Intent;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;
import android.os.IBinder;
import android.util.Log;

import com.flushout.fomonitor.General.General;
import com.flushout.fomonitor.Models.DeviceInfo;
import com.flushout.fomonitor.Models.LocationData;
import com.flushout.fomonitor.Models.LocationModel;
import com.flushout.fomonitor.Models.UserCompanySettings;

@SuppressLint("SimpleDateFormat")
public class Tracker extends Service implements LocationListener 
{
	private final Context mContext;
	private static final int TWO_MINUTES = 1000 * 60 * 2;
	
    boolean isGPSEnabled = false;
    boolean isNetworkEnabled = false;
 
    boolean canGetLocation = false;
    Location currentLocation;
    
    Location location; // location
    public static double latitude; // latitude
    public static double longitude; // longitude
    public static double speed; // speed
    public static double bearing; // bearing
    public static double accuracy; // accuracy
 
    // Declaring a Location Manager
    protected LocationManager locationManager;
 
    public Tracker(Context context) 
    {
        this.mContext = context;
        System.out.println("open trackk ");
        getLocation();
    }
    
    public Location getLocation() 
    {	
    	try 
    	{
    		Log.d("FomonitorLog", "Tracker->getLocation->begin");
    		locationManager = (LocationManager) mContext.getSystemService(LOCATION_SERVICE);
    		isGPSEnabled = locationManager.isProviderEnabled(LocationManager.GPS_PROVIDER);

    		isNetworkEnabled = locationManager.isProviderEnabled(LocationManager.NETWORK_PROVIDER);
    		//isNetworkEnabled = false;
    		Log.d("FomonitorLog", "Tracker->getLocation->1");
    		if (!isGPSEnabled && !isNetworkEnabled) 
    		{
    			// no network provider is enabled
    		} 
    		else 
    		{
    			Log.d("FomonitorLog", "Tracker->getLocation->2");
    			this.canGetLocation = true;
    			// First get location from Network Provider
    			
/*    			if (isNetworkEnabled) 
    			{
    				Log.d("FomonitorLog", "Tracker->getLocation->2 isNetworkEnabled->"+isNetworkEnabled);
    				locationManager.requestLocationUpdates(
    						LocationManager.NETWORK_PROVIDER,
    						UserCompanySettings.get_instance().gps_time * 60000,
    						UserCompanySettings.get_instance().gps_distance, this);
    				
    				
    				if (locationManager != null) 
    				{
    					Log.d("FomonitorLog", "Tracker->getLocation->2 isNetworkEnabled->locationManager");
    					location = locationManager.getLastKnownLocation(LocationManager.NETWORK_PROVIDER);
    	
    					if (location != null) 
    					{
    						Log.d("FomonitorLog", "Tracker->getLocation->2 isNetworkEnabled->location->"+location.getLatitude());
    						Tracker.latitude = location.getLatitude();
    						Tracker.longitude = location.getLongitude();
    						Tracker.speed = location.getSpeed();
    						Tracker.bearing = location.getBearing();
    						Tracker.accuracy = location.getAccuracy();
    					}
    				}
    			}
*/    	
    	
    			if (isGPSEnabled || isNetworkEnabled) 
    			{
    				Log.d("FomonitorLog", "Tracker->getLocation->2 isNetworkEnabled->"+isNetworkEnabled);
    				if (location == null) 
    				{
    					locationManager.requestLocationUpdates(
    							LocationManager.GPS_PROVIDER,
    							UserCompanySettings.get_instance().gps_time * 60000,
    							UserCompanySettings.get_instance().gps_distance, this);
    	
    	
    					if (locationManager != null) 
    					{
    						Log.d("FomonitorLog", "Tracker->getLocation->2 locationManager->");
    						location = locationManager.getLastKnownLocation(LocationManager.GPS_PROVIDER);
    						Log.d("FomonitorLog", "Tracker->getLocation->2 locationManager 1");
    						if (location != null) 
    						{
    							Log.d("FomonitorLog", "Tracker->getLocation->2 locationManager 1 location->"+location.getLatitude());
    							Tracker.latitude = location.getLatitude();
    							Tracker.longitude = location.getLongitude();
    							Tracker.speed = location.getSpeed();
    							Tracker.bearing = location.getBearing();
    							Tracker.accuracy = location.getAccuracy();
    						}
    					}
    				}
    			}
    		}

    	} 
    	catch (Exception e) 
    	{
    		e.printStackTrace();
    	}
    
    	return location;
    }
    
    @Override
    public void onLocationChanged(Location location) 
    {
    	Log.d("FomonitorLog", "Tracker->onLocationChanged->begin");
    	if (isBetterLocation(location, currentLocation))
    	{
    		Log.d("FomonitorLog", "Tracker->onLocationChanged->1");
    		Tracker.latitude = location.getLatitude();
        	Tracker.longitude = location.getLongitude();
        	Tracker.speed = location.getSpeed();
    		Tracker.bearing = location.getBearing();
    		Tracker.accuracy = location.getAccuracy();
        	
    		SimpleDateFormat sdf = new SimpleDateFormat("yyyyMMddHHmmss");
    		String currentDateTime = sdf.format(new Date());
    		
    		Log.d("FomonitorLog", "Tracker->onLocationChanged->PhoneNumber->"+DeviceInfo.getPhoneNumber());
    		Log.d("FomonitorLog", "Tracker->onLocationChanged->speed->"+Tracker.speed);
    		Log.d("FomonitorLog", "Tracker->onLocationChanged->bearing->"+Tracker.bearing);
    		Log.d("FomonitorLog", "Tracker->onLocationChanged->date->"+currentDateTime);
    		LocationData locationData = new LocationData(
    				String.valueOf(Tracker.latitude), 
    				String.valueOf(Tracker.longitude), 
    				String.valueOf(Tracker.speed), 
    				DeviceInfo.getPhoneNumber(), 
    				String.valueOf(Tracker.bearing), 
    				String.valueOf(Tracker.accuracy), 
    				DeviceInfo.getBatteryLevel(), 
    				DeviceInfo.getGSMStrength(), 
    				DeviceInfo.getCarrier(), 
    				currentDateTime,
    				String.valueOf(DeviceInfo.getReceivedBytes()),
    				String.valueOf(DeviceInfo.getTransmittedBytes()));
        	LocationModel.get_model().save(locationData);
        	
        	String logTxt = "Date: "+currentDateTime+" / Tracker.latitude: " + Tracker.latitude + " / Tracker.longitude: " + Tracker.longitude + "\n";
        	
        	Log.d("FomonitorLog", "Tracker->onLocationChanged->txt1");
        	appendLog(logTxt);
        	Log.d("FomonitorLog", "Tracker->onLocationChanged->txt2");
        	currentLocation = location;
    	}
    	Log.d("FomonitorLog", "Tracker->onLocationChanged->end");
    }

	public void appendLog(String text)
	{       
	   File logFile = new File("sdcard/logOnLocationChanged.txt");
	   if (!logFile.exists())
	   {
	      try
	      {
	         logFile.createNewFile();
	      } 
	      catch (IOException e)
	      {
	         // TODO Auto-generated catch block
	         e.printStackTrace();
	      }
	   }
	   try
	   {
	      //BufferedWriter for performance, true to set append to file flag
	      BufferedWriter buf = new BufferedWriter(new FileWriter(logFile, true)); 
	      buf.append(text);
	      buf.newLine();
	      buf.close();
	   }
	   catch (IOException e)
	   {
	      // TODO Auto-generated catch block
	      e.printStackTrace();
	   }
	}
    
    @Override
    public void onProviderDisabled(String provider) 
    {
    }
    
    @Override
    public void onProviderEnabled(String provider) 
    {
    }
    
    @Override
    public void onStatusChanged(String provider, int status, Bundle extras) 
    {
    }
    
    @Override
    public IBinder onBind(Intent arg0) 
    {
    	return null;
    }
    
    /*
    * Function to check if best network provider
    * @return boolean
    * */
   
    public boolean canGetLocation() 
    {
    	return this.canGetLocation;
    } 
    
    // GPS Accuracy fixes
    
    protected boolean isBetterLocation(Location location, Location currentBestLocation) 
    {
        if (currentBestLocation == null) {
            // A new location is always better than no location
            return true;
        }

        // Check whether the new location fix is newer or older
        long timeDelta = location.getTime() - currentBestLocation.getTime();
        boolean isSignificantlyNewer = timeDelta > TWO_MINUTES;
        boolean isSignificantlyOlder = timeDelta < -TWO_MINUTES;
        boolean isNewer = timeDelta > 0;

        // If it's been more than two minutes since the current location, use the new location
        // because the user has likely moved
        if (isSignificantlyNewer) {
            return true;
        // If the new location is more than two minutes older, it must be worse
        } else if (isSignificantlyOlder) {
            return false;
        }

        // Check whether the new location fix is more or less accurate
        int accuracyDelta = (int) (location.getAccuracy() - currentBestLocation.getAccuracy());
        boolean isLessAccurate = accuracyDelta > 0;
        boolean isMoreAccurate = accuracyDelta < 0;
        boolean isSignificantlyLessAccurate = accuracyDelta > 200;

        // Check if the old and new location are from the same provider
        boolean isFromSameProvider = isSameProvider(location.getProvider(),
                currentBestLocation.getProvider());

        
        // Determine location quality using a combination of timeliness and accuracy
        if (isMoreAccurate) {
            return true;
        } else if (isNewer && !isLessAccurate) {
            return true;
        } else if (isNewer && !isSignificantlyLessAccurate && isFromSameProvider) {
            return true;
        }
        return false;
    }

    /** Checks whether two providers are the same */
    private boolean isSameProvider(String provider1, String provider2) 
    {
        if (provider1 == null) 
        {
        	return provider2 == null;
        }
        return provider1.equals(provider2);
    }
}
