package trgovina.ep.ep_trgovina;

import android.content.Intent;
import android.support.annotation.IdRes;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import trgovina.ep.ep_trgovina.adapters.SlikaAdapter;
import trgovina.ep.ep_trgovina.models.Izdelek;
import trgovina.ep.ep_trgovina.models.IzdelekResponse;
import trgovina.ep.ep_trgovina.seja.SessionVar;

public class PodrobnostIzdelka extends AppCompatActivity implements Callback<IzdelekResponse> {

    private TextView izdelek_ime;
    private TextView izdelek_cena;
    private TextView izdelek_opis;
    private long idIzdelka;
    private IzdelekResponse izdelekResp;
    private ListView slike;
    private SlikaAdapter slikaAdapter;
    private Button btn_nazaj;
    private int kategorijaId;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_podrobnost_izdelka);

        izdelek_cena = (TextView) findViewById(R.id.izd_cena);
        izdelek_ime = (TextView) findViewById(R.id.izd_naziv);
        izdelek_opis = (TextView) findViewById(R.id.izd_opis);
        slike = (ListView) findViewById(R.id.seznam_slik);
        btn_nazaj = (Button) findViewById(R.id.btn_nazaj_3);

        btn_nazaj.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(PodrobnostIzdelka.this, SeznamIzdelkov.class);
                Bundle bundle = new Bundle();
                bundle.putInt("kategorija.id", kategorijaId);
                intent.putExtras(bundle);
                startActivity(intent);
            }
        });

        idIzdelka = preberiID(getIntent());

        if(idIzdelka > 0){
            IzdelekService.getInstance().vrniEnega(idIzdelka).enqueue(PodrobnostIzdelka.this);
        }
    }

    @Override
    public void onResponse(Call<IzdelekResponse> call, Response<IzdelekResponse> response) {
        izdelekResp = response.body();

        if(response.isSuccessful()){
            slikaAdapter = new SlikaAdapter(PodrobnostIzdelka.this, izdelekResp.slike);
            slike.setAdapter(slikaAdapter);

            izdelek_cena.setText(String.valueOf(izdelekResp.izdelek.cena));
            izdelek_opis.setText(izdelekResp.izdelek.opis);
            izdelek_ime.setText(izdelekResp.izdelek.ime);
            kategorijaId = izdelekResp.izdelek.kategorija;
        } else {
            Toast.makeText(this, "Napaka pri pridobivanju podatkov o izdelku!", Toast.LENGTH_LONG).show();
        }
    }

    @Override
    public void onFailure(Call<IzdelekResponse> call, Throwable t) {
        Log.e("NAPAKA", "napaka: " + t.getMessage(), t);
        Toast.makeText(this, "Napaka pri pridobivanju podatkov o izdelku!", Toast.LENGTH_LONG).show();
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

    @Override
    public void onBackPressed() {
        SessionVar session = (SessionVar) getApplicationContext();
        if(session != null){
            if(session.prijavljeniUporabnik != null){
                super.onBackPressed();
            }
        }
    }
}
