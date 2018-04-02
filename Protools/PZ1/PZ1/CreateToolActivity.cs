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
using Android.Media;

namespace PZ1
{
    [Activity(Label = "Sklep z narzędziami - Dodaj", Theme = "@android:style/Theme.Holo.Light")]
    public class CreateToolActivity : Activity
    {
        private ImageView _imageView;
        private Button btCreate, btTakePhoto;
        private EditText etNazwa, etOpis, etCena;
        byte[] photoArray = new byte[]{};
        protected override void OnCreate(Bundle savedInstanceState)
        {


            base.OnCreate(savedInstanceState);
            SetContentView(Resource.Layout.CreateToolActivity);

            btCreate = FindViewById<Button>(Resource.Id.buttonCreateNewTool);
            etNazwa = FindViewById<EditText>(Resource.Id.editTextNazwa);
            etOpis = FindViewById<EditText>(Resource.Id.editTextOpis);
            etCena = FindViewById<EditText>(Resource.Id.editTextCena);

            btCreate.Click += BtCreate_Click;

            if (IsThereAnAppToTakePictures())
            {
                CreateDirectoryForPictures();

                Button button = FindViewById<Button>(Resource.Id.buttonTakePhoto);
                 _imageView = FindViewById<ImageView>(Resource.Id.imageView1);
                button.Click += TakeAPicture;
            }
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

        void BtCreate_Click(object sender, EventArgs e)
        {
                MySqlConnection con = new MySqlConnection(@"Server=192.168.0.101;Port=3306;database=baza_sklep;User Id=bazasklep;Password=1qaz@WSX;charset=utf8");
            try
            {
                con.Open();
                string query = "Insert into Narzedzia (Nazwa,Opis,Cena,Zdjecie,ZdjecieDlugosc) values ('" + etNazwa.Text + "','" + etOpis.Text + "'," + etCena.Text + ",@image, " + photoArray.Length +")";
                MySqlCommand cmd = new MySqlCommand(query, con);
                cmd.Parameters.Add("@image", MySqlDbType.LongBlob).Value = photoArray;
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
    }
    public static class App
    {
        public static File _file;
        public static File _dir;
        public static Bitmap bitmap;
    }
    public static class BitmapHelpers
    {
        public static Bitmap LoadAndResizeBitmap(this string fileName, int width, int height)
        {
            // First we get the the dimensions of the file on disk
            BitmapFactory.Options options = new BitmapFactory.Options { InJustDecodeBounds = true };
            BitmapFactory.DecodeFile(fileName, options);

            // Next we calculate the ratio that we need to resize the image by
            // to fit the requested dimensions.
            int outHeight = options.OutHeight;
            int outWidth = options.OutWidth;
            int inSampleSize = 1;

            //if (outHeight > height || outWidth > width)
            //{
            //    inSampleSize = outWidth > outHeight
            //                       ? outHeight / height
            //                       : outWidth / width;
            //}

            // Now we will load the image and have BitmapFactory resize it for us.
            options.InSampleSize = inSampleSize;
            options.InJustDecodeBounds = false;
            Bitmap resizedBitmap = BitmapFactory.DecodeFile(fileName, options);

            return resizedBitmap;
        }
    }
}