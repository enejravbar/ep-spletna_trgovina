package trgovina.ep.ep_trgovina;

import java.util.List;

import retrofit2.Call;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;
import retrofit2.http.GET;
import trgovina.ep.ep_trgovina.models.Kategorija;

/**
 * Created by miha on 31.12.2017.
 */

public class KategorijaService {

    interface RESTApi {

        String HOST_LOKALNEGA_RACUNALNIKA = "10.0.2.2";
        String URL = "http://" + HOST_LOKALNEGA_RACUNALNIKA + "/pstorm/ep-spletna_trgovina/api/";

        @GET("kategorije")
        Call<List<Kategorija>> vrniVse();

    }

    private static RESTApi instance;

    public static synchronized RESTApi getInstance(){
        if(instance == null) {
            final Retrofit retrofit = new Retrofit.Builder()
                    .baseUrl(UporabnikService.RESTApi.URL)
                    .addConverterFactory(GsonConverterFactory.create())
                    .build();
            instance = retrofit.create(RESTApi.class);
        }
        return instance;
    }
}
