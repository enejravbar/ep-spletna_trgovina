package trgovina.ep.ep_trgovina;

import android.content.Intent;
import android.support.annotation.IdRes;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import trgovina.ep.ep_trgovina.models.Izdelek;

public class PodrobnostIzdelka extends AppCompatActivity implements Callback<Izdelek> {

    private TextView izdelek_ime;
    private TextView izdelek_cena;
    private TextView izdelek_opis;
    private long idIzdelka;
    private Izdelek izdelek;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_podrobnost_izdelka);

        izdelek_cena = (TextView) findViewById(R.id.izd_cena);
        izdelek_ime = (TextView) findViewById(R.id.izd_naziv);
        izdelek_opis = (TextView) findViewById(R.id.izd_opis);

        idIzdelka = preberiID(getIntent());

        if(idIzdelka > 0){
            IzdelekService.getInstance().vrniEnega(idIzdelka).enqueue(PodrobnostIzdelka.this);
        }
    }

    @Override
    public void onResponse(Call<Izdelek> call, Response<Izdelek> response) {
        izdelek = response.body();

        if(response.isSuccessful()){
            izdelek_cena.setText(String.valueOf(izdelek.cena));
            izdelek_opis.setText(izdelek.opis);
            izdelek_ime.setText(izdelek.ime);
        } else {
            Toast.makeText(this, "NAPAKA!", Toast.LENGTH_SHORT).show();
        }
    }

    @Override
    public void onFailure(Call<Izdelek> call, Throwable t) {
        Log.e("NAPAKA", "napaka: " + t.getMessage(), t);
    }

    private long preberiID(Intent intent){
        if(intent != null){
            final Bundle bundle = intent.getExtras();
            if(bundle != null){
                return bundle.getLong("izdelek.id");
            }
        }
        return 0;
    }
}
