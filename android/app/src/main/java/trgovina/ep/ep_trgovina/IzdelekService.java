package trgovina.ep.ep_trgovina;

import java.util.List;

import retrofit2.Call;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;
import retrofit2.http.GET;
import retrofit2.http.Path;
import trgovina.ep.ep_trgovina.models.Izdelek;
import trgovina.ep.ep_trgovina.models.IzdelekResponse;

/**
 * Created by miha on 31.12.2017.
 */

public class IzdelekService {

    interface RESTApi {

        String HOST_LOKALNEGA_RACUNALNIKA = "10.0.2.2";
        String URL = "http://" + HOST_LOKALNEGA_RACUNALNIKA + "/ep/ep-spletna_trgovina/api/";

        @GET("kategorije/{id}/izdelki")
        Call<List<Izdelek>> vrniVsePoKategoriji(@Path("id") int id);

        @GET("izdelki/{id}")
        Call<IzdelekResponse> vrniEnega(@Path("id") long id);

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
