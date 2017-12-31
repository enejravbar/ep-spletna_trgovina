package trgovina.ep.ep_trgovina.adapters;

import android.content.Context;
import android.support.annotation.NonNull;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import java.util.ArrayList;

import trgovina.ep.ep_trgovina.R;
import trgovina.ep.ep_trgovina.models.Kategorija;

/**
 * Created by miha on 31.12.2017.
 */

public class KategorijaAdapter extends ArrayAdapter<Kategorija> {


    public KategorijaAdapter(Context context) {
        super(context, 0, new ArrayList<Kategorija>());
    }

    @Override
    public View getView(int position, View convertView, @NonNull ViewGroup parent){
        final Kategorija kategorija = getItem(position);

        if(convertView == null){
            convertView = LayoutInflater.from(getContext()).inflate(R.layout.kategorija_list_element, parent, false);
        }

        final TextView kategorijaTitle = convertView.findViewById(R.id.kategorija_title);
        kategorijaTitle.setText(kategorija.ime);

        return convertView;
    }
}
