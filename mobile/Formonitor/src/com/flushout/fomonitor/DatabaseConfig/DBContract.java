package com.flushout.fomonitor.DatabaseConfig;

import android.provider.BaseColumns;

public class DBContract 
{
	private DBContract() {}
	
	public static abstract class LocationSchema implements BaseColumns 
	{
		public static final String TABLE_NAME = "location";
		public static final String COLUMN_NAME_LAT = "lat";
	    public static final String COLUMN_NAME_LON = "lon";
	    public static final String COLUMN_NAME_SPEED = "speed";
	    public static final String COLUMN_NAME_PHONE_NUMBER= "phonenumber";
	    public static final String COLUMN_NAME_BEARING= "bearing";
	    public static final String COLUMN_NAME_ACCURACY= "accuracy";
	    public static final String COLUMN_NAME_BATTERY_LEVEL = "battery_level";
	    public static final String COLUMN_NAME_GSM_STRENGTH= "gsmstrength";
	    public static final String COLUMN_NAME_CARRIER= "carrier";
	    public static final String COLUMN_NAME_DATETIME = "datetime";
	    public static final String COLUMN_NAME_BYTES_RX = "bytes_rx";
	    public static final String COLUMN_NAME_BYTES_TX = "bytes_tx";
	    
	}
	
	public static abstract class AppsSchema implements BaseColumns 
	{
		public static final String TABLE_NAME = "apps";
		public static final String COLUMN_NAME_PACKAGE_NAME= "package_name";
	}
}
