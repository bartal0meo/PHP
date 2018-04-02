using Android.App;
using Android.Widget;
using Android.OS;
using System.Data;
using Android.Content;
using Android.Runtime;
using Android.Views;
using System;
using MySql.Data.MySqlClient;

namespace PZ1
{

    [Activity(Label = "Sklep z narzędziami", MainLauncher = true, Theme = "@android:style/Theme.Holo.Light")]
    public class MainActivity : Activity
    {
        private EditText etLogin, etPassword;
        private Button btLogin;
        private TextView txtSysLog;

        protected override void OnCreate(Bundle savedInstanceState)
        {
            base.OnCreate(savedInstanceState);

            // Set our view from the "main" layout resource
            SetContentView(Resource.Layout.Main);

            etLogin = FindViewById<EditText>(Resource.Id.editTextLogin);
            etPassword = FindViewById<EditText>(Resource.Id.editTextPassword);
            btLogin = FindViewById<Button>(Resource.Id.buttonLogin);
            txtSysLog = FindViewById<TextView>(Resource.Id.textViewLoginLog);

            btLogin.Click += BtLogin_Click;

        }

        private void BtLogin_Click(object sender, EventArgs e)
        {
                MySqlConnection con = new MySqlConnection(@"Server=192.168.0.101;Port=3306;database=baza_sklep;User Id=bazasklep;Password=1qaz@WSX;charset=utf8");
                //MySqlConnection con = new MySqlConnection(@"Server=mysql.cba.pl;database=bartal;User Id=bartal;Password=Informatyka2018");
            try
            {
                con.Open();
                string query = "Select Count(Id) from Uzytkownicy where Login like '" + etLogin.Text + "' and Password like '" + etPassword.Text + "'";
                MySqlCommand cmd = new MySqlCommand(query, con);
                if (Convert.ToInt32(cmd.ExecuteScalar().ToString().Replace(" ", "")) == 0)
                {
                    txtSysLog.Text = "Błędne dane logowania!";
                }
                else
                {
                    Intent nextActivity = new Intent(this, typeof(AfterLoginActivity));
                   // nextActivity.PutExtra("login", etLogin.Text);
                    StartActivity(nextActivity);
                }
            }
            catch (Exception ex)
            {
                txtSysLog.Text = ex.ToString();
            }
            finally
            {
                con.Close();
            }


        }
    }
}

