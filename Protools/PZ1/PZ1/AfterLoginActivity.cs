using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

using Android.App;
using Android.Content;
using Android.OS;
using Android.Runtime;
using Android.Views;
using Android.Widget;

namespace PZ1
{
    [Activity(Label = "Sklep z narzędziami", Theme = "@android:style/Theme.Holo.Light")]
    public class AfterLoginActivity : Activity
    {
        Button btAddNewTool, btAllTools, btLogout;
        protected override void OnCreate(Bundle savedInstanceState)
        {
            base.OnCreate(savedInstanceState);
            SetContentView(Resource.Layout.AfterLogin);
            btAddNewTool = FindViewById<Button>(Resource.Id.buttonALAddNewTool);
            btAllTools = FindViewById<Button>(Resource.Id.buttonALAllTools);
            btLogout = FindViewById<Button>(Resource.Id.buttonALLogout);

            btAddNewTool.Click += BtAddNewTool_Click;
            btAllTools.Click += BtAllTools_Click;
            btLogout.Click += BtLogout_Click;
        }

        private void BtLogout_Click(object sender, EventArgs e)
        {
            Intent nextActivity = new Intent(this, typeof(MainActivity));
            StartActivity(nextActivity);
        }

        private void BtAllTools_Click(object sender, EventArgs e)
        {
            Intent nextActivity = new Intent(this, typeof(AllToolsActivity));
            StartActivity(nextActivity);
        }

        private void BtAddNewTool_Click(object sender, EventArgs e)
        {
            Intent nextActivity = new Intent(this, typeof(CreateToolActivity));
            StartActivity(nextActivity);
        }
    }
}