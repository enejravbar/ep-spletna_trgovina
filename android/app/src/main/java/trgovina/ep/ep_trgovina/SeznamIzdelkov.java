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
import android.widget.Toast;

import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import trgovina.ep.ep_trgovina.adapters.IzdelekAdapter;
import trgovina.ep.ep_trgovina.models.Izdelek;
import trgovina.ep.ep_trgovina.seja.SessionVar;

public class SeznamIzdelkov extends AppCompatActivity implements Callback<List<Izdelek>> {

    private ListView seznam;
    private SwipeRefreshLayout container;
    private IzdelekAdapter izdelekAdapter;
    private int idKategorije;
    private Button logout_btn2;
    private Button profile_btn2;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_seznam_izdelkov);

        idKategorije = preberiID(getIntent());

        seznam = (ListView) findViewById(R.id.izdelki);
        logout_btn2 = (Button) findViewById(R.id.logout_btn2);
        profile_btn2 = (Button) findViewById(R.id.profile_btn2);

        izdelekAdapter = new IzdelekAdapter(this);
        seznam.setAdapter(izdelekAdapter);
        seznam.setOnItemClickListener(new AdapterView.OnItemClickListener(){

            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                final Izdelek izdelek = izdelekAdapter.getItem(position);
                if(izdelek != null){
                    final Intent intent = new Intent(SeznamIzdelkov.this, PodrobnostIzdelka.class);
                    Bundle bundle = new Bundle();
                    bundle.putLong("izdelek.id", izdelek.id);
                    intent.putExtras(bundle);
                    startActivity(intent);
                }
            }
        });

        logout_btn2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                SessionVar session = (SessionVar) getApplicationContext();
                if(session != null){
                    session.prijavljeniUporabnik = null;
                    Intent intent = new Intent(SeznamIzdelkov.this, MainActivity.class);
                    startActivity(intent);
                } else {
                    Toast.makeText(SeznamIzdelkov.this, "Napaka pri odjavi!", Toast.LENGTH_SHORT).show();
                }
            }
        });

        profile_btn2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(SeznamIzdelkov.this, UporabnikovProfil.class);
                startActivity(intent);
            }
        });

        container = (SwipeRefreshLayout) findViewById(R.id.izdelki_container);
        container.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener(){
            @Override
            public void onRefresh() {
                if(idKategorije > 0){
                    IzdelekService.getInstance().vrniVsePoKategoriji(idKategorije).enqueue(SeznamIzdelkov.this);
                }
            }
        });

        if(idKategorije > 0){
            IzdelekService.getInstance().vrniVsePoKategoriji(idKategorije).enqueue(SeznamIzdelkov.this);
        }

    }

    @Override
    public void onResponse(Call<List<Izdelek>> call, Response<List<Izdelek>> response) {
        final List<Izdelek> rezultati = response.body();

        if(response.isSuccessful()){
            izdelekAdapter.clear();
            izdelekAdapter.addAll(rezultati);
        } else {
            Toast.makeText(this, "Napaka pri pridobivanju izdelkov!", Toast.LENGTH_LONG).show();
        }
        container.setRefreshing(false);
    }

    @Override
    public void onFailure(Call<List<Izdelek>> call, Throwable t) {
        container.setRefreshing(false);
        Toast.makeText(this, "Napaka pri pridobivanju izdelkov!", Toast.LENGTH_LONG).show();
    }

    private int preberiID(Intent intent){
        if(intent != null){
            final Bundle bundle = intent.getExtras();
            if(bundle != null){
                return bundle.getInt("kategorija.id");
            }
        }
        return 0;
    }
}
