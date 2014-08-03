package com.flushout.fomonitor.Models;

import java.util.ArrayList;
import java.util.List;

import android.content.ContentValues;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.util.Log;

import com.flushout.fomonitor.DatabaseConfig.DBContract;
import com.flushout.fomonitor.DatabaseConfig.DBHelper;
import com.flushout.fomonitor.General.General;

public class LocationModel 
{
	private DBHelper dbHelper = DBHelper.getHelper(General.getAppContext());
	private static LocationModel instance = null;

	public static LocationModel get_model()
	{
		if (instance==null)
			instance = new LocationModel();
			
		return instance;
	}
	
	private LocationModel()
	{
		
	}
	
	public synchronized LocationData get_data(int id) 
	{
		Log.d("FomonitorLog", "LocationModel->LocationData get_data->begin");
		SQLiteDatabase db = dbHelper.getWritableDatabase();
		Log.d("FomonitorLog", "LocationModel->LocationData get_data->1");
		Cursor curApp = db.rawQuery("SELECT * FROM "+DBContract.LocationSchema.TABLE_NAME+" WHERE _ID="+id, null);
		Log.d("FomonitorLog", "LocationModel->LocationData get_data->2");
		LocationData appData = null;
		Log.d("FomonitorLog", "LocationModel->LocationData get_data->3");
		if (curApp.moveToFirst()) 
	    {
			Log.d("FomonitorLog", "LocationModel->LocationData get_data->1");
			int _id = curApp.getInt(0);
			String lat = curApp.getString(1);
			String lon = curApp.getString(2);
			String speed = curApp.getString(3);
			String accuracy = curApp.getString(4);
			String battery_level = curApp.getString(5);
			String bearing = curApp.getString(6);
			String carrier = curApp.getString(7);
			String gsmstrength = curApp.getString(8);
			String phonenumber = curApp.getString(9);
			String datetime = curApp.getString(10);
			String bytes_rx = curApp.getString(11);
			String bytes_tx = curApp.getString(12);
			
			appData = new LocationData(_id, lat, lon, speed, phonenumber, bearing, accuracy, battery_level, gsmstrength, carrier, datetime, bytes_rx, bytes_tx);
	    }
		curApp.close();
		
		return appData;
	}
	
	public synchronized void add(LocationData data)
	{
		if (null!=data)
		{
			SQLiteDatabase db = dbHelper.getWritableDatabase();
			
			ContentValues values = new ContentValues();
			values.put(DBContract.LocationSchema.COLUMN_NAME_LAT, data.lat);
			values.put(DBContract.LocationSchema.COLUMN_NAME_LON, data.lon);
			values.put(DBContract.LocationSchema.COLUMN_NAME_SPEED, data.speed);
			values.put(DBContract.LocationSchema.COLUMN_NAME_PHONE_NUMBER, data.phonenumber);
			values.put(DBContract.LocationSchema.COLUMN_NAME_BEARING, data.bearing);
			values.put(DBContract.LocationSchema.COLUMN_NAME_ACCURACY, data.accuracy);
			values.put(DBContract.LocationSchema.COLUMN_NAME_BATTERY_LEVEL, data.battery_level);
			values.put(DBContract.LocationSchema.COLUMN_NAME_GSM_STRENGTH, data.gsmstrength);
			values.put(DBContract.LocationSchema.COLUMN_NAME_CARRIER, data.carrier);
			values.put(DBContract.LocationSchema.COLUMN_NAME_DATETIME, data.datetime);
			values.put(DBContract.LocationSchema.COLUMN_NAME_BYTES_RX, data.bytes_rx);
			values.put(DBContract.LocationSchema.COLUMN_NAME_BYTES_TX, data.bytes_tx);
			
			db.insert(DBContract.LocationSchema.TABLE_NAME, null, values);
		}
	}
	
	
	public synchronized void update(LocationData data)
	{
		if (null!=data)
		{
			SQLiteDatabase db = dbHelper.getWritableDatabase();
			
			ContentValues values = new ContentValues();
			values.put(DBContract.LocationSchema.COLUMN_NAME_LAT, data.lat);
			values.put(DBContract.LocationSchema.COLUMN_NAME_LON, data.lon);
			values.put(DBContract.LocationSchema.COLUMN_NAME_SPEED, data.speed);
			values.put(DBContract.LocationSchema.COLUMN_NAME_PHONE_NUMBER, data.phonenumber);
			values.put(DBContract.LocationSchema.COLUMN_NAME_BEARING, data.bearing);
			values.put(DBContract.LocationSchema.COLUMN_NAME_ACCURACY, data.accuracy);
			values.put(DBContract.LocationSchema.COLUMN_NAME_BATTERY_LEVEL, data.battery_level);
			values.put(DBContract.LocationSchema.COLUMN_NAME_GSM_STRENGTH, data.gsmstrength);
			values.put(DBContract.LocationSchema.COLUMN_NAME_CARRIER, data.carrier);
			values.put(DBContract.LocationSchema.COLUMN_NAME_DATETIME, data.datetime);
			values.put(DBContract.LocationSchema.COLUMN_NAME_BYTES_RX, data.bytes_rx);
			values.put(DBContract.LocationSchema.COLUMN_NAME_BYTES_TX, data.bytes_tx);
			
			db.update(DBContract.LocationSchema.TABLE_NAME, values, DBContract.LocationSchema._ID+"="+data._id, null);
		}
	}
	
	
	public synchronized void save(LocationData data)
	{
		Log.d("FomonitorLog", "LocationModel->save->begin");
		LocationData record = get_data(data._id);
		
		if (record==null)
			add(data);
		else
			update(data);
		
		Log.d("FomonitorLog", "LocationModel->save->end");
	}
	
	public synchronized List<LocationData> list() 
	{
		SQLiteDatabase db = dbHelper.getWritableDatabase();
		
		List<LocationData> list = new ArrayList<LocationData>();
	    String selectQuery = "SELECT  * FROM " + DBContract.LocationSchema.TABLE_NAME;
	
		Cursor curApp = db.rawQuery(selectQuery, null);
		
		if (curApp.moveToFirst())
		{
			do
			{
				LocationData appData = get_data(curApp.getInt(0));
				list.add(appData);
			}
			while (curApp.moveToNext());
		}
		
		curApp.close();
		
	    return list;
	}
	
	public synchronized List<LocationData> list(int limit) 
	{
		Log.d("FomonitorLog", "LocationModel->List<LocationData> list->begin");
		SQLiteDatabase db = dbHelper.getWritableDatabase();
		Log.d("FomonitorLog", "LocationModel->List<LocationData> list->1");
		List<LocationData> list = new ArrayList<LocationData>();
		Log.d("FomonitorLog", "LocationModel->List<LocationData> list->2");
	    String selectQuery = "SELECT  * FROM " + DBContract.LocationSchema.TABLE_NAME + " LIMIT "+limit;
	    Log.d("FomonitorLog", "LocationModel->List<LocationData> list->3");
		Cursor curApp = db.rawQuery(selectQuery, null);
		Log.d("FomonitorLog", "LocationModel->List<LocationData> list->4->curApp.moveToFirst()->"+curApp.moveToFirst());
		if (curApp.moveToFirst())
		{
			do
			{
				Log.d("FomonitorLog", "LocationModel->List<LocationData> list->5");
				LocationData appData = get_data(curApp.getInt(0));
				list.add(appData);
			}
			while (curApp.moveToNext());
		}
		Log.d("FomonitorLog", "LocationModel->List<LocationData> list->end");
		curApp.close();
		
	    return list;
	}
	
	public synchronized void delete(LocationData data)
	{
		SQLiteDatabase db = dbHelper.getWritableDatabase();
		db.delete(DBContract.LocationSchema.TABLE_NAME, DBContract.LocationSchema._ID +"="+data._id, null);
	}
	
	public synchronized void delete_all()
	{
		SQLiteDatabase db = dbHelper.getWritableDatabase();
		db.rawQuery("DELETE FROM "+DBContract.LocationSchema.TABLE_NAME, null);
	}
	
	public synchronized int get_count()
	{
		return list().size();
	}
}
