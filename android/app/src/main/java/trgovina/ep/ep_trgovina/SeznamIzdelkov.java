package trgovina.ep.ep_trgovina;

import android.content.Intent;
import android.support.v4.widget.SwipeRefreshLayout;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.Toast;

import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import trgovina.ep.ep_trgovina.adapters.IzdelekAdapter;
import trgovina.ep.ep_trgovina.models.Izdelek;

public class SeznamIzdelkov extends AppCompatActivity implements Callback<List<Izdelek>> {

    private ListView seznam;
    private SwipeRefreshLayout container;
    private IzdelekAdapter izdelekAdapter;
    private int idKategorije;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_seznam_izdelkov);

        idKategorije = preberiID(getIntent());

        seznam = (ListView) findViewById(R.id.izdelki);

        izdelekAdapter = new IzdelekAdapter(this);
        seznam.setAdapter(izdelekAdapter);
        seznam.setOnItemClickListener(new AdapterView.OnItemClickListener(){

            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                final Izdelek izdelek = izdelekAdapter.getItem(position);
                if(izdelek != null){
                    Log.i("TAG", "Prikazujem izdelek: " + izdelek.id);
                    final Intent intent = new Intent(SeznamIzdelkov.this, PodrobnostIzdelka.class);
                    Bundle bundle = new Bundle();
                    bundle.putLong("izdelek.id", izdelek.id);
                    intent.putExtras(bundle);
                    startActivity(intent);
                }
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
            Toast.makeText(this, "NAPAKA!", Toast.LENGTH_SHORT).show();
        }
        container.setRefreshing(false);
    }

    @Override
    public void onFailure(Call<List<Izdelek>> call, Throwable t) {
        container.setRefreshing(false);
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
