package com.flushout.fomonitor.General;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.util.Log;

public class InternetStatus 
{
	public static boolean isOnline() 
	{
		Log.d("RegisterActivity", "isOnline 1");
	    ConnectivityManager cm = (ConnectivityManager) General.getAppContext().getSystemService(Context.CONNECTIVITY_SERVICE);
	    Log.d("RegisterActivity", "isOnline 2");
	    NetworkInfo netInfo = cm.getActiveNetworkInfo();
	    Log.d("RegisterActivity", "isOnline 3");
	    if (netInfo != null && netInfo.isConnectedOrConnecting()) {
	    	Log.d("RegisterActivity", "isOnline 4");
	        return true;
	    }
	    Log.d("RegisterActivity", "isOnline 5");
	    return false;
	}
/*
	public static boolean isReachable() 
	{
	    //  First, check we have any sort of connectivity
	    final ConnectivityManager connMgr = (ConnectivityManager) General.getAppContext().getSystemService(Context.CONNECTIVITY_SERVICE);
	    final NetworkInfo netInfo = connMgr.getActiveNetworkInfo();

	    if (netInfo != null && netInfo.isConnected()) 
	    {
	        try {
	            URL url = new URL("http://rest.acview.airclic.net.br");
	            HttpURLConnection urlc = (HttpURLConnection) url.openConnection();
	            urlc.setRequestProperty("User-Agent", "Android Application");
	            urlc.setRequestProperty("Connection", "close");
	            urlc.setConnectTimeout(30 * 1000); // Thirty seconds timeout in milliseconds
	            urlc.connect();
	       
	          
	            if (urlc.getResponseCode() == 200) 
	            {
	                return true;
	            } 
	            else 
	            {
	                return false;
	            }
	        } catch (IOException e) 
	        {
	        	e.printStackTrace();
	            return false;
	        }
	    } 
	    else 
	    {
	        return false;
	    }
	}*/
}
