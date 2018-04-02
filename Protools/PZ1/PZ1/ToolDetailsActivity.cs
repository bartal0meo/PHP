using System;
using System.Collections.Generic;
using Android.App;
using Android.Content;
using Android.Content.Res;
using Android.Graphics;
using Android.OS;
using Android.Provider;
using Android.Widget;
using Java.IO;
using MySql.Data.MySqlClient;
using Android.Content.PM;
using Environment = Android.OS.Environment;
using Uri = Android.Net.Uri;


namespace PZ1
{
    [Activity(Label = "Edycja", Theme = "@android:style/Theme.Holo.Light")]
    public class ToolDetailsActivity : Activity
    {
        private ImageView _imageView;
        private EditText etNazwa, etOpis, etCena;
        private Button btSave;
        public string toolId;
        byte[] photoArray = new byte[]{};
        protected override void OnCreate(Bundle savedInstanceState)
        {
            base.OnCreate(savedInstanceState);
            SetContentView(Resource.Layout.EditTool);
            toolId = Intent.GetStringExtra("Id") ?? "0";
            _imageView = FindViewById<ImageView>(Resource.Id.imageViewEditToolPhoto);
            etNazwa = FindViewById<EditText>(Resource.Id.editTextEditToolNazwa);
            etOpis = FindViewById<EditText>(Resource.Id.editTextEditToolOpis);
            etCena = FindViewById<EditText>(Resource.Id.editTextEditToolCena);
            btSave = FindViewById<Button>(Resource.Id.buttonEditToolSave);
            // Create your application here
            var narzedzie = GetToolDetails();
            Bitmap zdjecie = bytesToBitmap(narzedzie.Zdjecie);
            etNazwa.Text = narzedzie.Nazwa;
            etCena.Text = narzedzie.Cena.ToString();
            etOpis.Text = narzedzie.Opis;
            int height = Resources.DisplayMetrics.HeightPixels;
            int width = _imageView.Height;
            _imageView.SetImageBitmap(zdjecie);
            btSave.Click += BtSave_Click;


            if (IsThereAnAppToTakePictures())
            {
                CreateDirectoryForPictures();
                Button button = FindViewById<Button>(Resource.Id.buttonEditToolTakePhoto);
                button.Click += TakeAPicture;
            }
        }
        protected override void OnActivityResult(int requestCode, Result resultCode, Intent data)
        {
            base.OnActivityResult(requestCode, resultCode, data);

            Intent mediaScanIntent = new Intent(Intent.ActionMediaScannerScanFile);
            Uri contentUri = Uri.FromFile(App._file);
            mediaScanIntent.SetData(contentUri);
            SendBroadcast(mediaScanIntent);

            int height = Resources.DisplayMetrics.HeightPixels;
            int width = _imageView.Height;
            App.bitmap = App._file.Path.LoadAndResizeBitmap(width, height);
            photoArray = System.IO.File.ReadAllBytes(App._file.Path);
            if (App.bitmap != null)
            {
                _imageView.SetImageBitmap(App.bitmap);
                App.bitmap = null;
            }

            GC.Collect();
        }
        private void TakeAPicture(object sender, EventArgs eventArgs)
        {
            Intent intent = new Intent(MediaStore.ActionImageCapture);
            App._file = new File(App._dir, String.Format("myPhoto_{0}.jpg", Guid.NewGuid()));
            intent.PutExtra(MediaStore.ExtraOutput, Uri.FromFile(App._file));
            StartActivityForResult(intent, 0);
        }
        private void CreateDirectoryForPictures()
        {
            App._dir = new File(
                Environment.GetExternalStoragePublicDirectory(
                    Environment.DirectoryPictures), "CameraAppDemo");
            if (!App._dir.Exists())
            {
                App._dir.Mkdirs();
            }
        }

        private bool IsThereAnAppToTakePictures()
        {
            Intent intent = new Intent(MediaStore.ActionImageCapture);
            IList<ResolveInfo> availableActivities =
                PackageManager.QueryIntentActivities(intent, PackageInfoFlags.MatchDefaultOnly);
            return availableActivities != null && availableActivities.Count > 0;
        }
        private void BtTakePhoto_Click(object sender, EventArgs e)
        {
            Intent intent = new Intent(MediaStore.ActionImageCapture);
            StartActivityForResult(intent, 1);
        }

        private void BtSave_Click(object sender, EventArgs e)
        {
            MySqlConnection con = new MySqlConnection(@"Server=192.168.0.101;Port=3306;database=baza_sklep;User Id=bazasklep;Password=1qaz@WSX;charset=utf8");
            try
            {
                con.Open();
                string query = $"Update Narzedzia set Nazwa = '{etNazwa.Text}', Opis = '{etOpis.Text}', Cena = {Convert.ToDecimal(etCena.Text)} ";
                MySqlCommand cmd = new MySqlCommand(query, con);
                //cmd.Parameters.Add("@image", MySqlDbType.LongBlob).Value = photoArray;
                cmd.ExecuteNonQuery();
                Intent nextActivity = new Intent(this, typeof(AllToolsActivity));
                StartActivity(nextActivity);
            }
            catch (Exception ex)
            {
            }
            finally
            {
                con.Close();
            }
        }

        public static Bitmap bytesToBitmap(byte[] imageBytes)
        {

            Bitmap bitmap = BitmapFactory.DecodeByteArray(imageBytes, 0, imageBytes.Length);

            return bitmap;
        }
        private Narzedzie GetToolDetails()
        {
            MySqlConnection con = new MySqlConnection(@"Server=192.168.0.101;Port=3306;database=baza_sklep;User Id=bazasklep;Password=1qaz@WSX;charset=utf8");
            Narzedzie result = new Narzedzie();
            try
            {
                con.Open();
                string query = $"Select Nazwa, Opis, Cena, Zdjecie, ZdjecieDlugosc from Narzedzia where Id like {toolId}";
                MySqlCommand cmd = new MySqlCommand(query, con);
                MySqlDataReader reader = cmd.ExecuteReader();

                if (reader.HasRows)
                {
                    while (reader.Read())
                    {
                        byte[] Zdjecie = new byte[reader.GetInt32(4)];
                        reader.GetBytes(reader.GetOrdinal("Zdjecie"), 0, Zdjecie, 0, reader.GetInt32(4));
                        result = new Narzedzie
                        {
                            Id = Convert.ToInt32(toolId),
                            Nazwa = reader.GetString(0),
                            Opis = reader.GetString(1),
                            Cena = reader.GetDecimal(2),
                            ZdjecieDlugosc = reader.GetInt32(4),
                            Zdjecie = Zdjecie
                    };
                }
                }
                reader.Close();
                return result;
            }
            catch (Exception ex)
            {
                return null;
            }
            finally
            {
                con.Close();
            }

        }
    }
    public class Narzedzie
    {
        public int Id { get; set; }

        public string Nazwa { get; set; }

        public string Opis { get; set; }

        public decimal Cena { get; set; }

        public byte[] Zdjecie { get; set; }

        public int ZdjecieDlugosc { get; set; }
    }
}