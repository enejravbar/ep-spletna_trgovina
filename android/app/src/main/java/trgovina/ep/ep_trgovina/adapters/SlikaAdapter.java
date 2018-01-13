package trgovina.ep.ep_trgovina.adapters;

import android.content.Context;
import android.media.Image;
import android.support.annotation.LayoutRes;
import android.support.annotation.NonNull;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.squareup.picasso.Picasso;

import java.util.ArrayList;

import trgovina.ep.ep_trgovina.R;
import trgovina.ep.ep_trgovina.models.Slika;
import trgovina.ep.ep_trgovina.tasks.DownloadImageTask;

/**
 * Created by miha on 1.1.2018.
 */

public class SlikaAdapter extends ArrayAdapter<Slika> {

    private Context context;

    private LayoutInflater inflater;

    private ArrayList<Slika> slike;

    public SlikaAdapter(Context context, ArrayList<Slika> slike) {
        super(context, R.layout.image_item, slike);
        this.context = context;
        this.slike = slike;
        inflater = LayoutInflater.from(context);
    }


    @Override
    public View getView(int position, View convertView, @NonNull ViewGroup parent){
        if(convertView == null){
            convertView = inflater.inflate(R.layout.image_item, parent, false);
        }

        long id_slike = slike.get(position).id;

        final String HOST_LOKALNEGA_RACUNALNIKA = "10.0.2.2";
        final String URL_SLIKE = "http://" + HOST_LOKALNEGA_RACUNALNIKA + "/ep/ep-spletna_trgovina/api/slike/" + id_slike;

        Picasso.with(context).load(URL_SLIKE).fit().into((ImageView) convertView);

        return convertView;
    }
}
