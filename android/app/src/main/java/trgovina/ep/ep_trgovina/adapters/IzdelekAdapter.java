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
import trgovina.ep.ep_trgovina.models.Izdelek;

/**
 * Created by miha on 31.12.2017.
 */

public class IzdelekAdapter extends ArrayAdapter<Izdelek> {

    public IzdelekAdapter(Context context) {
        super(context, 0, new ArrayList<Izdelek>());
    }

    @Override
    public View getView(int position, View convertView, @NonNull ViewGroup parent){
        final Izdelek izdelek = getItem(position);

        if(convertView == null){
            convertView = LayoutInflater.from(getContext()).inflate(R.layout.izdelek_list_element, parent, false);
        }

        final TextView izdelekTitle = convertView.findViewById(R.id.izdelek_title);
        final TextView izdelekIme = convertView.findViewById(R.id.izdelek_ime);
        final TextView izdelekCena = convertView.findViewById(R.id.izdelek_cena);

        izdelekTitle.setText(izdelek.ime);
        izdelekIme.setText(izdelek.ime);
        izdelekCena.setText(String.valueOf(izdelek.cena));

        return convertView;
    }
}
