package com.flushout.fomonitor.DatabaseConfig;

import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

public class DBHelper extends SQLiteOpenHelper
{
	public static final int DATABASE_VERSION = 3;
    public static final String DATABASE_NAME = "Location.db";
    
	private static final String TEXT_TYPE = " TEXT";
	private static final String INT_TYPE = " INTEGER";
	private static final String COMMA_SEP = ",";
	
	private static DBHelper instance;

    public static synchronized DBHelper getHelper(Context context)
    {
        if (instance == null)
            instance = new DBHelper(context);

        return instance;
    }
    
	private static final String SQL_CREATE_LOCATION =
		    "CREATE TABLE " + DBContract.LocationSchema.TABLE_NAME + " (" +
		    		DBContract.LocationSchema._ID + " "+INT_TYPE+" PRIMARY KEY," +
		    		DBContract.LocationSchema.COLUMN_NAME_LAT + TEXT_TYPE + COMMA_SEP +
		    		DBContract.LocationSchema.COLUMN_NAME_LON + TEXT_TYPE + COMMA_SEP +
		    		DBContract.LocationSchema.COLUMN_NAME_SPEED + TEXT_TYPE + COMMA_SEP +
		    		DBContract.LocationSchema.COLUMN_NAME_ACCURACY + TEXT_TYPE + COMMA_SEP +
		    		DBContract.LocationSchema.COLUMN_NAME_BATTERY_LEVEL + TEXT_TYPE + COMMA_SEP +
		    		DBContract.LocationSchema.COLUMN_NAME_BEARING + TEXT_TYPE + COMMA_SEP +
		    		DBContract.LocationSchema.COLUMN_NAME_CARRIER + TEXT_TYPE + COMMA_SEP +
		    		DBContract.LocationSchema.COLUMN_NAME_GSM_STRENGTH + TEXT_TYPE + COMMA_SEP +
		    		DBContract.LocationSchema.COLUMN_NAME_PHONE_NUMBER + TEXT_TYPE + COMMA_SEP +
		    		DBContract.LocationSchema.COLUMN_NAME_DATETIME + TEXT_TYPE + COMMA_SEP +
		    		DBContract.LocationSchema.COLUMN_NAME_BYTES_RX + TEXT_TYPE + COMMA_SEP +
		    		DBContract.LocationSchema.COLUMN_NAME_BYTES_TX + TEXT_TYPE +
		    " )";
	
	
	private static final String SQL_CREATE_APPS =
		    "CREATE TABLE " + DBContract.AppsSchema.TABLE_NAME + " (" +
		    		DBContract.AppsSchema._ID + " "+INT_TYPE+" PRIMARY KEY," +
		    		DBContract.AppsSchema.COLUMN_NAME_PACKAGE_NAME + TEXT_TYPE  +
		    " )";
	
	private static final String SQL_DELETE_LOCATION = "DROP TABLE IF EXISTS " + DBContract.LocationSchema.TABLE_NAME;
	private static final String SQL_DELETE_APPS = "DROP TABLE IF EXISTS " + DBContract.AppsSchema.TABLE_NAME;
	
	public DBHelper(Context context) 
	{
		super(context, DATABASE_NAME, null, DATABASE_VERSION);
	}


    @Override
	public void onCreate(SQLiteDatabase db) 
    {
    	db.execSQL(SQL_CREATE_LOCATION);
    	db.execSQL(SQL_CREATE_APPS);
	}

	@Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) 
	{
		db.execSQL(SQL_DELETE_LOCATION);
		db.execSQL(SQL_DELETE_APPS);
        onCreate(db);        
	}
}
