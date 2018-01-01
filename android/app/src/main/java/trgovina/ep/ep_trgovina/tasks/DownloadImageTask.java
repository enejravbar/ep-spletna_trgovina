package trgovina.ep.ep_trgovina.tasks;

import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.AsyncTask;
import android.widget.ImageView;
import java.net.URL;

import java.io.InputStream;

/**
 * Created by miha on 1.1.2018.
 */

public class DownloadImageTask extends AsyncTask<String, Void, Bitmap> {

    private ImageView imageView;

    public DownloadImageTask(ImageView imgView){
        this.imageView = imgView;
    }

    @Override
    protected Bitmap doInBackground(String... params) {
        String url = params[0];
        Bitmap slika = null;

        try {
            InputStream is = new URL(url).openStream();

            slika = BitmapFactory.decodeStream(is);
        } catch(Exception e){
            e.printStackTrace();
        }
        return slika;
    }

    protected void onPostExecute(Bitmap result){
        imageView.setImageBitmap(result);
    }

}
