package trgovina.ep.ep_trgovina.adapters;

import android.content.Context;
import android.graphics.Color;
import android.support.annotation.NonNull;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import com.squareup.picasso.Picasso;

import java.util.ArrayList;
import java.util.List;

import trgovina.ep.ep_trgovina.R;
import trgovina.ep.ep_trgovina.models.Posta;

/**
 * Created by miha on 1.1.2018.
 */

public class PostaAdapter extends ArrayAdapter<Posta> {

    private Context context;

    private ArrayList<Posta> poste;

    public PostaAdapter(Context context, int resourceID, ArrayList<Posta> poste) {
        super(context, resourceID, poste);
        this.context = context;
        this.poste = poste;
    }

    @Override
    public View getView(int position, View convertView, @NonNull ViewGroup parent){
        final Posta posta = poste.get(position);
        if(convertView == null){
            convertView = LayoutInflater.from(getContext()).inflate(R.layout.posta_item, parent, false);
        }
        final TextView postaElement = convertView.findViewById(R.id.posta_elem);
        postaElement.setText(String.valueOf(posta.postna_st + " " + posta.naziv));
        return convertView;
    }

    @Override
    public View getDropDownView(int position, View convertView, ViewGroup parent){
        final Posta posta = poste.get(position);
        if(convertView == null){
            convertView = LayoutInflater.from(getContext()).inflate(R.layout.posta_item, parent, false);
        }
        final TextView postaElement = convertView.findViewById(R.id.posta_elem);
        postaElement.setText(String.valueOf(posta.postna_st + " " + posta.naziv));
        return convertView;
    }
}
