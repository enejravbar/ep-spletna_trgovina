package trgovina.ep.ep_trgovina.adapters;

import android.content.Context;
import android.support.annotation.LayoutRes;
import android.support.annotation.NonNull;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import java.util.ArrayList;

import trgovina.ep.ep_trgovina.R;
import trgovina.ep.ep_trgovina.models.Slika;
import trgovina.ep.ep_trgovina.tasks.DownloadImageTask;

/**
 * Created by miha on 1.1.2018.
 */

public class SlikaAdapter extends ArrayAdapter<Slika> {

    public SlikaAdapter(Context context) {
        super(context, 0, new ArrayList<Slika>());
    }

    @Override
    public View getView(int position, View convertView, @NonNull ViewGroup parent){
        final Slika slika = getItem(position);

        if(convertView == null){
            convertView = LayoutInflater.from(getContext()).inflate(R.layout.image_item, parent, false);
        }

        final ImageView slikaItem = convertView.findViewById(R.id.slika);

        final String HOST_LOKALNEGA_RACUNALNIKA = "10.0.2.2";
        final String URL_SLIKE = "http://" + HOST_LOKALNEGA_RACUNALNIKA + "/pstorm/ep-spletna_trgovina/api/slike/" + slika.id;

        new DownloadImageTask(slikaItem).execute(URL_SLIKE);

        return convertView;
    }
}
