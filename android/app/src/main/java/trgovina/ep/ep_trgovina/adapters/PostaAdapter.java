package trgovina.ep.ep_trgovina.adapters;

import android.content.Context;
import android.graphics.Color;
import android.support.annotation.NonNull;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import java.util.ArrayList;
import java.util.List;

import trgovina.ep.ep_trgovina.models.Posta;

/**
 * Created by miha on 1.1.2018.
 */

public class PostaAdapter extends ArrayAdapter<Posta> {

    public PostaAdapter(Context context) {
        super(context, 0, new ArrayList<Posta>());
    }

    @Override
    public View getView(int position, View convertView, @NonNull ViewGroup parent){
        TextView label = new TextView(getContext());

        label.setTextColor(Color.BLACK);
        label.setText(getItem(position).naziv);

        return label;
    }

}
