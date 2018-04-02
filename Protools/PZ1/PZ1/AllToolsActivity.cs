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
using MySql.Data.MySqlClient;

namespace PZ1
{
    [Activity(Label = "Sklep z narzędziami - Lista", Theme = "@android:style/Theme.Holo.Light")]
    public class AllToolsActivity : Activity
    {
        private List<string> allTools;
        private ListView lvTools;
        private Button btAdd;
        protected override void OnCreate(Bundle savedInstanceState)
        {
                MySqlConnection con = new MySqlConnection(@"Server=192.168.0.101;Port=3306;database=baza_sklep;User Id=bazasklep;Password=1qaz@WSX;charset=utf8");
            //MySqlConnection con = new MySqlConnection("Server=db4free.net;Port=3307;database=baza_sklep2;User Id=bazasklep2;Password=1qaz@WSX;charset=utf8");
            base.OnCreate(savedInstanceState);


            SetContentView(Resource.Layout.AllToolsActivity);
            var userName = Intent.GetStringExtra("login" ?? "Empty");
            lvTools = FindViewById<ListView>(Resource.Id.listViewTools);
            btAdd = FindViewById<Button>(Resource.Id.buttonAddTool);
            allTools = new List<string>();

            try
            {
                con.Open();
                string query = "Select * from Narzedzia";
                MySqlCommand cmd = new MySqlCommand(query, con);
                MySqlDataReader dataReader = cmd.ExecuteReader();
                while (dataReader.Read())
                {
                    string Nazwa = dataReader["Nazwa"].ToString();
                    decimal Cena = Convert.ToDecimal(dataReader["Cena"]);
                    int Id = Convert.ToInt32(dataReader["Id"]);
                    allTools.Add($"{Id.ToString()} |  {Nazwa} Cena: {Cena.ToString()}");

                }
                dataReader.Close();
            }
            catch (Exception ex)
            {
            }
            finally
            {
                con.Close();
            }
            ArrayAdapter<string> adapter = new ArrayAdapter<string>(this, Android.Resource.Layout.SimpleListItem1, allTools);

            lvTools.Adapter = adapter;

            btAdd.Click += BtAdd_Click;
            lvTools.ItemClick += LvTools_ItemClick;
        }


        private void LvTools_ItemClick(object sender, AdapterView.ItemClickEventArgs e)
        {
            string value = allTools[e.Position];
            Intent nextActivity = new Intent(this, typeof(ToolDetailsActivity));
            nextActivity.PutExtra("Id", value.Split('|')[0].Replace(" ", ""));
            StartActivity(nextActivity);
        }

        private void BtAdd_Click(object sender, EventArgs e)
        {
            Intent nextActivity = new Intent(this, typeof(CreateToolActivity));
            StartActivity(nextActivity);
        }
    }
}