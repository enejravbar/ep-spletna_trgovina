package trgovina.ep.ep_trgovina;

import android.content.Intent;
import android.support.v4.widget.SwipeRefreshLayout;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import trgovina.ep.ep_trgovina.adapters.KategorijaAdapter;
import trgovina.ep.ep_trgovina.models.Kategorija;
import trgovina.ep.ep_trgovina.seja.SessionVar;

public class GlavnaStran extends AppCompatActivity implements Callback<List<Kategorija>> {

    private ListView seznam;
    private SwipeRefreshLayout container;
    private KategorijaAdapter kategorijaAdapter;
    private Button odjavaGumb;
    private Button profilGumb;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_glavna_stran);

        seznam = (ListView) findViewById(R.id.kategorije);

        // odjava
        odjavaGumb = (Button) findViewById(R.id.logout_btn);
        odjavaGumb.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(GlavnaStran.this, MainActivity.class);
                startActivity(intent);
            }
        });

        // profil uporabnika
        profilGumb = (Button) findViewById(R.id.profile_btn);
        profilGumb.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                //pojdi na stran profila
            }
        });

        // populate seznam
        kategorijaAdapter = new KategorijaAdapter(this);
        seznam.setAdapter(kategorijaAdapter);
        seznam.setOnItemClickListener(new AdapterView.OnItemClickListener(){

            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                final Kategorija kategorija = kategorijaAdapter.getItem(position);
                if(kategorija != null){
                    Log.i("TAG", "menjam na pogled kategorije");
                    final Intent intent = new Intent(GlavnaStran.this, SeznamIzdelkov.class);
                    Bundle bundle = new Bundle();
                    bundle.putInt("kategorija.id", kategorija.id);
                    intent.putExtras(bundle);
                    startActivity(intent);
                }
            }
        });

        // on refresh
        container = (SwipeRefreshLayout) findViewById(R.id.kategorije_container);
        container.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener(){
            @Override
            public void onRefresh() {
                KategorijaService.getInstance().vrniVse().enqueue(GlavnaStran.this);
            }
        });

        KategorijaService.getInstance().vrniVse().enqueue(GlavnaStran.this);
    }

    @Override
    public void onResponse(Call<List<Kategorija>> call, Response<List<Kategorija>> response) {
        final List<Kategorija> rezultati = response.body();

        if(response.isSuccessful()){
            kategorijaAdapter.clear();
            kategorijaAdapter.addAll(rezultati);
        } else {
            Toast.makeText(this, "NAPAKA!", Toast.LENGTH_SHORT).show();
        }
        container.setRefreshing(false);
    }

    @Override
    public void onFailure(Call<List<Kategorija>> call, Throwable t) {
        container.setRefreshing(false);
    }
}
