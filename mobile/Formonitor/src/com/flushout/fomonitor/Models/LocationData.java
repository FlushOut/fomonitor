package com.flushout.fomonitor.Models;

public class LocationData 
{
	public int _id;
	public String lat;
	public String lon;
	public String speed;
	public String phonenumber;
	public String bearing;
	public String accuracy;
	public String battery_level;
	public String gsmstrength;
	public String carrier;
	public String datetime;
	public String bytes_rx;
	public String bytes_tx;
	
	public LocationData(int _id, String lat, String lon, String speed, String phonenumber, String bearing, String accuracy, String battery_level, String gsmstrength, String carrier, String datetime, String bytes_rx, String bytes_tx)
	{
		this._id = _id;
		this.lat = lat;
		this.lon = lon;
		this.speed = speed;
		this.phonenumber = phonenumber;
		this.bearing = bearing;
		this.accuracy = accuracy;
		this.battery_level = battery_level;
		this.gsmstrength = gsmstrength;
		this.carrier = carrier;
		this.datetime = datetime;
		this.bytes_rx = bytes_rx;
		this.bytes_tx = bytes_tx;
	}
	
	public LocationData(String lat, String lon, String speed, String phonenumber, String bearing, String accuracy, String battery_level, String gsmstrength, String carrier, String datetime, String bytes_rx, String bytes_tx)
	{
		this.lat = lat;
		this.lon = lon;
		this.speed = speed;
		this.phonenumber = phonenumber;
		this.bearing = bearing;
		this.accuracy = accuracy;
		this.battery_level = battery_level;
		this.gsmstrength = gsmstrength;
		this.carrier = carrier;
		this.datetime = datetime;
		this.bytes_rx = bytes_rx;
		this.bytes_tx = bytes_tx;
	}
}
