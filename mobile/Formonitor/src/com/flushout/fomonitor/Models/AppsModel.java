package com.flushout.fomonitor.Models;

import java.util.ArrayList;
import java.util.List;

import android.content.ContentValues;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;

import com.flushout.fomonitor.DatabaseConfig.DBContract;
import com.flushout.fomonitor.DatabaseConfig.DBHelper;
import com.flushout.fomonitor.General.General;

public class AppsModel 
{
	private DBHelper dbHelper = DBHelper.getHelper(General.getAppContext());
	private static AppsModel instance = null;

	public static AppsModel get_model()
	{
		if (instance==null)
			instance = new AppsModel();
			
		return instance;
	}
	
	private AppsModel()
	{

	}
	
	public synchronized AppsData get_data(int id) 
	{
		SQLiteDatabase db = dbHelper.getWritableDatabase();
		Cursor curApp = db.rawQuery("SELECT * FROM "+DBContract.AppsSchema.TABLE_NAME+" WHERE _ID="+id, null);
		
		AppsData appData = null;
		
		if (curApp.moveToFirst()) 
	    {
			int _id = curApp.getInt(0);
			String packageName = curApp.getString(1);
			
			appData = new AppsData(_id, packageName);
	    }
		curApp.close();
		
		return appData;
	}
	
	public synchronized AppsData get_data(String pck) 
	{
		SQLiteDatabase db = dbHelper.getWritableDatabase();
		Cursor curApp = db.rawQuery("SELECT * FROM "+DBContract.AppsSchema.TABLE_NAME+" WHERE "+DBContract.AppsSchema.COLUMN_NAME_PACKAGE_NAME+" = '"+pck+"'", null);
		
		AppsData appData = null;
		
		if (curApp.moveToFirst()) 
	    {
			int _id = curApp.getInt(0);
			String packageName = curApp.getString(1);
			
			appData = new AppsData(_id, packageName);
	    }
		curApp.close();
		
		return appData;
	}
	
	public synchronized void add(AppsData data)
	{
		if (null!=data)
		{
			SQLiteDatabase db = dbHelper.getWritableDatabase();
			
			ContentValues values = new ContentValues();
			values.put(DBContract.AppsSchema.COLUMN_NAME_PACKAGE_NAME, data.packageName);
			
			db.insert(DBContract.AppsSchema.TABLE_NAME, null, values);
		}
	}
	
	
	public synchronized void update(AppsData data)
	{
		if (null!=data)
		{
			SQLiteDatabase db = dbHelper.getWritableDatabase();
			
			ContentValues values = new ContentValues();
			values.put(DBContract.AppsSchema.COLUMN_NAME_PACKAGE_NAME, data.packageName);
			
			db.update(DBContract.AppsSchema.TABLE_NAME, values, DBContract.AppsSchema._ID+"="+data._id, null);
		}
	}
	
	
	public synchronized void save(AppsData data)
	{
		AppsData record = get_data(data._id);
		
		if (record==null)
			add(data);
		else
			update(data);
	}
	
	public synchronized List<AppsData> list() 
	{
		SQLiteDatabase db = dbHelper.getWritableDatabase();
		
		List<AppsData> list = new ArrayList<AppsData>();
	    String selectQuery = "SELECT * FROM " + DBContract.AppsSchema.TABLE_NAME;
	
		Cursor curApp = db.rawQuery(selectQuery, null);
		
		if (curApp.moveToFirst())
		{
			do
			{
				AppsData appData = get_data(curApp.getInt(0));
				list.add(appData);
			}
			while (curApp.moveToNext());
		}
		
		curApp.close();
		
		
	    return list;
	}
	
	public synchronized List<String> listPackages() 
	{
		List<String> list = new ArrayList<String>();
		List<AppsData> appList = new ArrayList<AppsData>(); 
		
		appList = list();
		
		int count = appList.size();
		
		for (int v=0; v<count; v++)
		{
			list.add(appList.get(v).packageName);
		}
		
	    return list;
	}
	
	public synchronized void delete(AppsData data)
	{
		SQLiteDatabase db = dbHelper.getWritableDatabase();
		db.delete(DBContract.AppsSchema.TABLE_NAME, DBContract.AppsSchema._ID +"="+data._id, null);
	}
	
	public synchronized void delete_all()
	{
		SQLiteDatabase db = dbHelper.getWritableDatabase();
		db.delete(DBContract.AppsSchema.TABLE_NAME, null, null);
	}
	
	public synchronized int get_count()
	{
		return list().size();
	}
}
