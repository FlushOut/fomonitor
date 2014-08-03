package com.flushout.fomonitor.WebService;

import java.io.IOException;

import org.apache.http.HttpResponse;
import org.apache.http.auth.AuthScope;
import org.apache.http.auth.UsernamePasswordCredentials;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.ResponseHandler;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.BasicResponseHandler;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.params.BasicHttpParams;
import org.apache.http.params.HttpConnectionParams;
import org.apache.http.params.HttpParams;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.SharedPreferences;
import android.net.Proxy;
import android.os.AsyncTask;
import android.text.method.PasswordTransformationMethod;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.EditText;

import com.flushout.fomonitor.R;
import com.flushout.fomonitor.General.General;

public class WSConnect extends AsyncTask<String, Object, JSONObject>
{
	public static final String SERVER = "http://r-monitor.flushoutsolutions.com/index.php?";
	String url = "";
	
	@Override
	protected JSONObject doInBackground(String... urls) 
	{
		Log.d("FomonitorLog", "WSConnect->doInBackground->begin");
		url = urls[0];
		
		// Proxy settings
		String proxyHost = Proxy.getDefaultHost();
		int proxyPort = Proxy.getDefaultPort();
		Log.d("FomonitorLog", "WSConnect->doInBackground->1 url=" + url);
		HttpGet get = new HttpGet(url);
		Log.d("FomonitorLog", "WSConnect->doInBackground->2");
		HttpParams httpParameters = new BasicHttpParams();
		HttpConnectionParams.setConnectionTimeout(httpParameters, 30*1000);
		HttpConnectionParams.setSoTimeout(httpParameters, 45*1000);
		Log.d("FomonitorLog", "WSConnect->doInBackground->3");
		DefaultHttpClient client = new DefaultHttpClient(httpParameters);
		Log.d("FomonitorLog", "WSConnect->doInBackground->4");
		if (null!=proxyHost)
		{
			Log.d("FomonitorLog", "WSConnect->doInBackground->4.1");
			final SharedPreferences settings = General.getAppContext().getSharedPreferences("settings", 0);
			Log.d("FomonitorLog", "WSConnect->doInBackground->4.2");
			if (settings.getBoolean("proxyRequiresAuth", false))
			{
				Log.d("FomonitorLog", "WSConnect->doInBackground->4.2.1");
				client.getCredentialsProvider().setCredentials(
					    new AuthScope(proxyHost, proxyPort),
					    new UsernamePasswordCredentials(settings.getString("proxyUser", ""), settings.getString("proxyPass", "")));
				Log.d("FomonitorLog", "WSConnect->doInBackground->4.2.2");
			}
		}
		Log.d("FomonitorLog", "WSConnect->doInBackground->5");
		ResponseHandler<String> responseHandler = new BasicResponseHandler();
		Log.d("FomonitorLog", "WSConnect->doInBackground->6");
		try 
		{
			Log.d("FomonitorLog", "WSConnect->doInBackground->7");
			HttpResponse response = client.execute(get);
			String respo = responseHandler.handleResponse(response);
			Log.d("FomonitorLog", "WSConnect->doInBackground->8 respo="+ respo);
			if (null!=respo)
			{
				Log.d("FomonitorLog", "WSConnect->doInBackground->8.1");
				respo = respo.substring(respo.indexOf("{"));
				Log.d("FomonitorLog", "WSConnect->doInBackground->8.2");
				try 
				{
					Log.d("FomonitorLog", "WSConnect->doInBackground->8.3 end");
					return new JSONObject(respo);
				} 
				catch (JSONException e) 
				{
					Log.d("FomonitorLog", "WSConnect->doInBackground->8.3 exception");
					e.printStackTrace();
				}
			}
			
			return null; 
		} 
		catch (ClientProtocolException e) 
		{
			Log.d("FomonitorLog", "WSConnect->doInBackground->9");
			if (e.getMessage().equals("Proxy Authentication Required"))
			{
				Log.d("FomonitorLog", "WSConnect->doInBackground->10");
				General.currentInstance.runOnUiThread(new Runnable()
				{
					@Override
					public void run() 
					{
						displayProxyDialog();
					}
					
				});
				
			}
			else
			{
				e.printStackTrace();
			}
		}
		catch (IOException e) 
		{
			Synchronize.tries ++;
			e.printStackTrace();
		}       
		Log.d("FomonitorLog", "WSConnect->doInBackground->end");
		return null;
	}
	
	@Override
	protected void onPostExecute(JSONObject result) 
	{        
		// Return
	}
	
	public void displayProxyDialog()
	{
		LayoutInflater li = LayoutInflater.from(General.getAppContext());
		View promptsView = li.inflate(R.layout.proxy_prompt, null);

		AlertDialog.Builder alertDialogBuilder = new AlertDialog.Builder(General.currentInstance);

		// set prompts.xml to alertdialog builder
		alertDialogBuilder.setView(promptsView);

		final EditText proxyUserInput = (EditText) promptsView.findViewById(R.id.txtProxyUser);
		final EditText proxyPassInput = (EditText) promptsView.findViewById(R.id.txtProxyPass);

		proxyPassInput.setTransformationMethod(PasswordTransformationMethod.getInstance());
		
		// set dialog message
		alertDialogBuilder
			.setTitle("Autentica?‹o do proxy")
			.setCancelable(false)
			.setPositiveButton("OK",
			  new DialogInterface.OnClickListener() {
			    public void onClick(DialogInterface dialog,int id) 
			    {
			    	SharedPreferences settings = General.getAppContext().getSharedPreferences("settings", 0);
			    	SharedPreferences.Editor editor = settings.edit();
			    	editor.putBoolean("proxyRequiresAuth", true);
			    	editor.putString("proxyUser", proxyUserInput.getText().toString());
			    	editor.putString("proxyPass", proxyPassInput.getText().toString());
			    	editor.commit();
			    }
			  })
			.setNegativeButton("Cancel",
			  new DialogInterface.OnClickListener() {
			    public void onClick(DialogInterface dialog,int id) {
				dialog.cancel();
			    }
			  });

		// create alert dialog
		AlertDialog alertDialog = alertDialogBuilder.create();

		// show it
		alertDialog.show();
	}
}
