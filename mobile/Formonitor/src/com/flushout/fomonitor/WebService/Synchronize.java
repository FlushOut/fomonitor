package com.flushout.fomonitor.WebService;

import java.io.BufferedWriter;
import java.io.File;
import java.io.FileOutputStream;
import java.io.FileWriter;
import java.io.IOException;
import java.io.UnsupportedEncodingException;
import java.net.URLEncoder;
import java.util.ArrayList;
import java.util.List;
import java.util.concurrent.ExecutionException;
import java.util.concurrent.Executors;
import java.util.concurrent.ScheduledExecutorService;
import java.util.concurrent.ScheduledFuture;
import java.util.concurrent.TimeUnit;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.content.Context;
import android.content.Intent;
import android.content.pm.ApplicationInfo;
import android.content.pm.PackageManager;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.drawable.Drawable;
import android.media.Image;
import android.util.Log;

import com.flushout.fomonitor.MainActivity; //import com.flushout.fomonitor.MainActivity;
import com.flushout.fomonitor.General.General;
import com.flushout.fomonitor.General.Passwords;
import com.flushout.fomonitor.Models.AppsData;
import com.flushout.fomonitor.Models.AppsModel;
import com.flushout.fomonitor.Models.DeviceInfo;
import com.flushout.fomonitor.Models.LocationData;
import com.flushout.fomonitor.Models.LocationModel;
import com.flushout.fomonitor.Models.UserCompanySettings;
import com.flushout.fomonitor.Models.UserInfo;
import com.flushout.fomonitor.Models.UserSettings;

public class Synchronize 
{
	public static ScheduledFuture<?> scheduledFuture;
	public static int tries = 0;
	
	public static boolean verifyAuthentication(String useremail, String codeAuthenticationu){
		try 
		{
			useremail = URLEncoder.encode(useremail, "UTF-8");
		} 
		catch (UnsupportedEncodingException e1) 
		{
			e1.printStackTrace();
		}
		String url = WSConnect.SERVER+"verifyAuthentication/email/"+useremail+"/code/"+codeAuthenticationu;
		Log.d("Synchronize", "verifyAuthentication 6 -> "+url);
		WSConnect wsc = new WSConnect();
		wsc.execute(url);
		
		try 
		{
			JSONObject json = wsc.get();
			
			if (null == json)
				return false;
			else
			{
				if (json.isNull("status"))
					return false;
				else
					return json.getBoolean("status");
			}
		} 
		catch (InterruptedException e) 
		{
			e.printStackTrace();
		}
		catch (ExecutionException e) 
		{
			e.printStackTrace();
		} 
		catch (JSONException e) 
		{
			e.printStackTrace();
		} 
		
		return false;
	}
	
	public static boolean sendRegisterUser(String activationCode, String username, String pinhash, String categoryId, String useremail)
	{
		Log.d("Synchronize", "sendRegisterUser 1 --> " + pinhash);
		//String pinhash = Passwords.getPinHash(pin, DeviceInfo.getIMEI());
		Log.d("Synchronize", "sendRegisterUser 2");
		String deviceManufacturer = DeviceInfo.getManufacturer();
		Log.d("Synchronize", "sendRegisterUser 3");
		String deviceModel = DeviceInfo.getModel();
		Log.d("Synchronize", "sendRegisterUser 4");
		try 
		{
			username = URLEncoder.encode(username, "UTF-8");
			useremail = URLEncoder.encode(useremail, "UTF-8");
			deviceManufacturer = URLEncoder.encode(deviceManufacturer, "UTF-8");
			deviceModel = URLEncoder.encode(deviceModel, "UTF-8");
		} 
		catch (UnsupportedEncodingException e1) 
		{
			e1.printStackTrace();
		}
		Log.d("Synchronize", "sendRegisterUser 5");
		String url = WSConnect.SERVER+"send_information/email/"+useremail+"/model/"+deviceModel+"/manufacturer/"+deviceManufacturer+"/code/"+activationCode+"/name/"+username+"/password/"+pinhash+"/category/"+categoryId+"/date/"+General.getDateTimeString();
		Log.d("Synchronize", "sendRegisterUser 6 -> "+url);
		WSConnect wsc = new WSConnect();
		Log.d("Synchronize", "sendRegisterUser 7");
		wsc.execute(url);
		Log.d("Synchronize", "sendRegisterUser 8");
		try 
		{
			JSONObject json = wsc.get();
			Log.d("Synchronize", "sendRegisterUser 9");
			if (null == json)
				return false;
			else
			{
				if (json.isNull("status"))
					return false;
				else
					return json.getBoolean("status");
			}
		} 
		catch (InterruptedException e) 
		{
			e.printStackTrace();
		}
		catch (ExecutionException e) 
		{
			e.printStackTrace();
		} 
		catch (JSONException e) 
		{
			e.printStackTrace();
		} 
		
		return false;
	}
	
	public static void sendApps()
	{

		Context ctx = General.getAppContext();

		final PackageManager pm = ctx.getPackageManager();

		List<ApplicationInfo> allApps = pm.getInstalledApplications(PackageManager.GET_META_DATA);

		for (int i=0; i< allApps.size(); i++)
		{

			ApplicationInfo appInfo = allApps.get(i);
			Intent launchApp = ctx.getPackageManager().getLaunchIntentForPackage(appInfo.packageName);

			if(launchApp != null)
			{

				if (!appInfo.packageName.contains("com.flushout.fomonitor")) 
				{
					boolean appsent = false;
					tries = 0;
					do
					{
						String appname = appInfo.loadLabel(pm).toString();
						appname = appname.replace("/", "[\\]");
						try 
						{
							appname = URLEncoder.encode(appname, "UTF-8");
						} 
						catch (UnsupportedEncodingException e1) 
						{
							e1.printStackTrace();
						} 
						
/*						Bitmap icon = BitmapFactory.decodeResource(ctx.getResources(),appInfo.icon);

						FileOutputStream out = null;
						try {
						       out = new FileOutputStream(appname);
						       icon.compress(Bitmap.CompressFormat.PNG, 90, out);
						} catch (Exception e) {
						    e.printStackTrace();
						} finally {
						       try{
						           out.close();
						       } catch(Throwable ignore) {}
						}*/
						
						String url = WSConnect.SERVER+"send_apps/email/"+UserInfo.getUserEmailEncode()+"/name/"+appname+"/package/"+appInfo.packageName;
						
						WSConnect wsc = new WSConnect();
						wsc.execute(url);
						try 
						{
							JSONObject result = wsc.get();

							if (null!=result)
							{
								if (!result.isNull("status"))
								{
									appsent = result.getBoolean("status");
									tries++;
									
									System.out.println("appsent "+appname+" package "+appInfo.packageName+" "+result.getBoolean("status")+" tries "+tries);
									
								}
							}
						} 
						catch (InterruptedException e) 
						{
							e.printStackTrace();
							System.out.println("DEBB1");
						}
						catch (ExecutionException e) 
						{
							e.printStackTrace();
							System.out.println("DEBB2");
						} 
						catch (JSONException e) 
						{
							e.printStackTrace();
							System.out.println("DEBB3");
						}
						
					}
					while(appsent==false && tries<=3);
					
					tries = 0;
				}
			}
		}
	}
	
	public static void sendLocation()
	{
		Log.d("FomonitorLog", "Synchronize->sendLocation->begin");
		List<LocationData> last20spots = LocationModel.get_model().list(40);
		Log.d("FomonitorLog", "Synchronize->sendLocation->1");
		int totalSpots = last20spots.size();
		Log.d("FomonitorLog", "Synchronize->sendLocation->2 totalSpots->"+totalSpots);
		for (int v=0; v<totalSpots; v++)
		{
			Log.d("FomonitorLog", "Synchronize->sendLocation->3");
			LocationData data = last20spots.get(v);

				String carrier;
				if (null == data.carrier || data.carrier.isEmpty() )
					carrier = "nocarrier";
				else
					carrier = data.carrier;
				
				String phonenumber;
				if (null == data.phonenumber || data.phonenumber.isEmpty())
					phonenumber = "nosimcard";
				else
					phonenumber = data.phonenumber;
				
				String gsmstrength;
				if (null == data.gsmstrength || data.gsmstrength.isEmpty())
					gsmstrength = "99";
				else
					gsmstrength = data.gsmstrength;
				
				String battery_level;
				if (null == data.battery_level || data.battery_level.isEmpty())
					battery_level = "-1";
				else
					battery_level = data.battery_level;
				
				try 
				{
					carrier = URLEncoder.encode(carrier, "UTF-8");
				} catch (UnsupportedEncodingException e) 
				{
					e.printStackTrace();
				}
				Log.d("FomonitorLog", "Synchronize->sendLocation->4");
				//Log.d("FomonitorLog", "Synchronize->sendLocation->5 Imei->"+DeviceInfo.getIMEI());
				
				String url = WSConnect.SERVER+"send_data/id/"+data._id+"/email/"+UserInfo.getUserEmailEncode()+"/lat/"+data.lat+"/lon/"+data.lon+"/speed/"+data.speed+"/phonenumber/"+phonenumber+"/bearing/"+data.bearing+"/accuracy/"+data.accuracy+"/batterylevel/"+battery_level+"/gsmstrength/"+gsmstrength+"/carrier/"+carrier+"/date/"+data.datetime+"/bytes_rx/"+data.bytes_rx+"/bytes_tx/"+data.bytes_tx;
				Log.d("FomonitorLog", "Synchronize->sendLocation->6 url->"+url);
				appendLog(url + "\n");
				WSConnect wsc = new WSConnect();
				wsc.execute(url);
				
/*				try 
				{
					JSONObject result = wsc.get();
				} 
				catch (InterruptedException e) 
				{
					e.printStackTrace();
				} 
				catch (ExecutionException e) 
				{
					e.printStackTrace();
				}*/
			
			LocationModel.get_model().delete(data);
		}
		Log.d("FomonitorLog", "Synchronize->sendLocation->end");
	}
	
	public static void appendLog(String text)
	{       
	   File logFile = new File("sdcard/logSendLocation.txt");
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
	
	public static int downloadVersion()
	{
		String url = WSConnect.SERVER+"version";
		WSConnect wsc = new WSConnect();
		wsc.execute(url);
		
		try 
		{
			JSONObject returnJSON = wsc.get();
			
			if (null!=returnJSON)
			{
				return returnJSON.getInt("ver");
			}
		} 
		catch (InterruptedException e) 
		{
			e.printStackTrace();
		}
		catch (ExecutionException e) 
		{
			e.printStackTrace();
		} 
		catch (JSONException e) 
		{
			e.printStackTrace();
		}
		
		return 0;
	}
	
	public static int downloadLastUserID()
	{
		String url = WSConnect.SERVER+"lastuserid";
		WSConnect wsc = new WSConnect();
		wsc.execute(url);
		
		try 
		{
			JSONObject returnJSON = wsc.get();
			
			if (null!=returnJSON)
			{
				return returnJSON.getInt("lastid");
			}
		} 
		catch (InterruptedException e) 
		{
			e.printStackTrace();
		}
		catch (ExecutionException e) 
		{
			e.printStackTrace();
		} 
		catch (JSONException e) 
		{
			e.printStackTrace();
		}
		
		return 0;
	}
	
	public static void downloadCompanySettings()
	{
		String url = WSConnect.SERVER+"getcompanysettings/email/"+UserInfo.getUserEmailEncode();
		Log.d("Synchronize", "downloadCompanySettings 1 --> "+url);
		WSConnect wsc = new WSConnect();
		wsc.execute(url);
		
		try 
		{
			JSONObject returnJSON = wsc.get();
			
			if (null!=returnJSON)
			{
				Log.d("Synchronize", "downloadCompanySettings 2");
				JSONObject jsonConfig = returnJSON.getJSONObject("settings");
				Log.d("Synchronize", "downloadCompanySettings 3");
				UserCompanySettings.updateSettings(jsonConfig.getInt("gps_time"), jsonConfig.getInt("gps_distance"), jsonConfig.getInt("status_payment"));
				Log.d("Synchronize", "downloadCompanySettings 4");
			}
		} 
		catch (InterruptedException e) 
		{
			e.printStackTrace();
		}
		catch (ExecutionException e) 
		{
			e.printStackTrace();
		} 
		catch (JSONException e) 
		{
			e.printStackTrace();
		}
	}
	
	public static void downloadUserData()
	{
		String url = WSConnect.SERVER+"getuserdata/email/"+UserInfo.getUserEmailEncode();
		WSConnect wsc = new WSConnect();
		wsc.execute(url);
		
		try 
		{
			JSONObject returnJSON = wsc.get();
			
			if (null!=returnJSON)
			{
				String userName = returnJSON.getString("name");
				String userEmail = returnJSON.getString("email");
				UserInfo.setUserInfo(userName, UserInfo.getPark(),userEmail,true);
			}
		} 
		catch (InterruptedException e) 
		{
			e.printStackTrace();
		}
		catch (ExecutionException e) 
		{
			e.printStackTrace();
		} 
		catch (JSONException e) 
		{
			e.printStackTrace();
		}
	}
	
	public static void downloadAllowedSettingsMenu()
	{
		String url = WSConnect.SERVER+"get_settings/email/"+UserInfo.getUserEmailEncode();
		WSConnect wsc = new WSConnect();
		Log.d("Synchronize", "downloadAllowedSettingsMenu 1 --> "+url);
		wsc.execute(url);
		
		try 
		{
			JSONObject returnJSON = wsc.get();
			Log.d("Synchronize", "downloadAllowedSettingsMenu 2");	
			if (null!=returnJSON)
			{
				Log.d("Synchronize", "downloadAllowedSettingsMenu 3");
				UserSettings.updateSettings(returnJSON.getJSONArray("settings").getJSONObject(0));
				Log.d("Synchronize", "downloadAllowedSettingsMenu 4");
			}
		} 
		catch (InterruptedException e) 
		{
			e.printStackTrace();
		}
		catch (ExecutionException e) 
		{
			e.printStackTrace();
		} 
		catch (JSONException e) 
		{
			e.printStackTrace();
		}
	}
	
	public static void downloadAllowedApps(boolean firstRun)
	{
		String url = WSConnect.SERVER+"get_apps/email/"+UserInfo.getUserEmailEncode();
		Log.d("Synchronize", "downloadAllowedApps 1 -> "+url);
		WSConnect wsc = new WSConnect();
		wsc.execute(url);
		
		try 
		{
			JSONObject result = wsc.get();
			
			if (null != result)
			{
				if (!result.isNull("status"))
				{
					if (result.getBoolean("status"))
					{
						Log.d("Synchronize", "downloadAllowedApps 2");
						List<String> listCurrentApps = new ArrayList<String>();
						listCurrentApps = AppsModel.get_model().listPackages();
						Log.d("Synchronize", "downloadAllowedApps 3");
						AppsModel.get_model().delete_all();
						if ("null"!=result.getString("apps"))
						{
							JSONArray arrApps = result.getJSONArray("apps");
							int numApps = arrApps.length();
							Log.d("Synchronize", "downloadAllowedApps 4");
							System.out.println("Aplications allowed "+result);
							Log.d("Synchronize", "downloadAllowedApps 5");
							for (int v=0; v<numApps; v++)
							{
								JSONObject record = arrApps.getJSONObject(v);
								AppsData appData = new AppsData(record.getString("package"));
								AppsModel.get_model().save(appData);
							}
							
							if (!firstRun)
							{
								if (!General.areEqualLists(listCurrentApps, AppsModel.get_model().listPackages()))
								{
									MainActivity.getInstance().runOnUiThread(new Runnable() 
									{
									     public void run() 
									     {
									    	 MainActivity.getInstance().updateAppListOnMainThread();
									     }
									});
								}
							}
						}
					}
				}
			}
			
		} 
		catch (InterruptedException e1) 
		{
			e1.printStackTrace();
		} 
		catch (ExecutionException e1) 
		{
			e1.printStackTrace();
		} 
		catch (JSONException e) 
		{
			e.printStackTrace();
		}
	}
	
	public static String downloadPinhash()
	{
		String url = WSConnect.SERVER+"getuserdata/email/"+UserInfo.getUserEmailEncode();
		WSConnect wsc = new WSConnect();
		wsc.execute(url);
		
		try 
		{
			JSONObject result = wsc.get();

			if (null != result)
			{
				return result.getString("password");
/*				if (!result.isNull("status"))
				{
					if (result.getBoolean("status"))
					{
						return result.getString("pinhash");
					}
				}*/
			}
		} 
		catch (InterruptedException e) 
		{
			e.printStackTrace();
		}
		catch (ExecutionException e) 
		{
			e.printStackTrace();
		} 
		catch (JSONException e) 
		{
			e.printStackTrace();
		}
		
		return null;
	}
	
	public static void startTasks()
	{
		ScheduledExecutorService scheduledExecutorService =  Executors.newScheduledThreadPool(5);

		scheduledFuture = scheduledExecutorService.scheduleWithFixedDelay(
			new Runnable() 
			{
				@Override
				public void run() 
				{
					Context ctx = General.getAppContext();
					Intent connIntent = new Intent(MainActivity.getInstance(), IntentConnection.class);
					ctx.startService(connIntent);
				}
			
		    }, 90, 90, TimeUnit.SECONDS);
		
	}
}
