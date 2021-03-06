package trgovina.ep.ep_trgovina;

import android.content.Intent;
import android.os.Bundle;
import android.support.v4.widget.SwipeRefreshLayout;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.ListView;
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
    private Button prijavaGumb;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_glavna_stran);

        seznam = (ListView) findViewById(R.id.kategorije);

        prijavaGumb = (Button) findViewById(R.id.login_btn);
        odjavaGumb = (Button) findViewById(R.id.logout_btn);
        profilGumb = (Button) findViewById(R.id.profile_btn);

        SessionVar sess = (SessionVar) getApplicationContext();
        if(sess != null) {
            if(sess.prijavljeniUporabnik == null) {
                prijavaGumb.setVisibility(View.VISIBLE);
                odjavaGumb.setVisibility(View.GONE);
                profilGumb.setVisibility(View.GONE);
            } else {
                prijavaGumb.setVisibility(View.GONE);
                odjavaGumb.setVisibility(View.VISIBLE);
                profilGumb.setVisibility(View.VISIBLE);
            }
        } else {
            Toast.makeText(GlavnaStran.this, "Napaka pri pridobivanju seje!", Toast.LENGTH_LONG).show();
        }

        // prijava
        prijavaGumb.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(GlavnaStran.this, MainActivity.class);
                startActivity(intent);
            }
        });

        // odjava
        odjavaGumb.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                SessionVar session = (SessionVar) getApplicationContext();
                if(session != null){
                    session.prijavljeniUporabnik = null;
                    Toast.makeText(GlavnaStran.this, "Uspešna odjava!", Toast.LENGTH_SHORT).show();
                    prijavaGumb.setVisibility(View.VISIBLE);
                    odjavaGumb.setVisibility(View.GONE);
                    profilGumb.setVisibility(View.GONE);
                } else {
                    Toast.makeText(GlavnaStran.this, "Napaka pri odjavi!", Toast.LENGTH_SHORT).show();
                }
            }
        });

        // profil uporabnika

        profilGumb.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(GlavnaStran.this, UporabnikovProfil.class);
                startActivity(intent);
            }
        });

        // populate seznam kategorij
        kategorijaAdapter = new KategorijaAdapter(this);
        seznam.setAdapter(kategorijaAdapter);
        seznam.setOnItemClickListener(new AdapterView.OnItemClickListener(){

            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                final Kategorija kategorija = kategorijaAdapter.getItem(position);
                if(kategorija != null){
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
            Toast.makeText(this, "Napaka pri pridobivanju kategorij!", Toast.LENGTH_LONG).show();
        }
        container.setRefreshing(false);
    }

    @Override
    public void onFailure(Call<List<Kategorija>> call, Throwable t) {
        container.setRefreshing(false);
        Toast.makeText(this, "Napaka pri pridobivanju kategorij!", Toast.LENGTH_LONG).show();
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
