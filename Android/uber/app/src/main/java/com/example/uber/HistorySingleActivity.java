package com.example.uber;

import android.support.annotation.NonNull;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.format.DateFormat;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.bumptech.glide.Glide;
import com.directions.route.AbstractRouting;
import com.directions.route.Route;
import com.directions.route.RouteException;
import com.directions.route.Routing;
import com.directions.route.RoutingListener;
import com.google.android.gms.maps.CameraUpdate;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.BitmapDescriptorFactory;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.LatLngBounds;
import com.google.android.gms.maps.model.MarkerOptions;
import com.google.android.gms.maps.model.Polyline;
import com.google.android.gms.maps.model.PolylineOptions;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.ValueEventListener;

import java.util.ArrayList;
import java.util.Calendar;
import java.util.List;
import java.util.Locale;
import java.util.Map;

public class HistorySingleActivity extends AppCompatActivity implements OnMapReadyCallback, RoutingListener {

    private GoogleMap mMap;
    private SupportMapFragment mMapFragment;

    private  String rideId, currentUserId, customerId, driverId, userDriverOrCustomer;

    private TextView locationRide;
    private TextView distanceRide;
    private TextView dateRide;
    private TextView nameUser;
    private TextView phoneUser;

    private ImageView imageUser;

    private DatabaseReference historyRideInfoDb;

    private LatLng destinationLatLng, pickupLatLng;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_history_single);

        polylines= new ArrayList<>();
        rideId = getIntent().getExtras().getString("rideId");

        locationRide = (TextView) findViewById(R.id.rideLocation);
        distanceRide = (TextView) findViewById(R.id.rideDistance);
        dateRide = (TextView) findViewById(R.id.rideDate);
        nameUser = (TextView) findViewById(R.id.userName);
        phoneUser = (TextView) findViewById(R.id.userPhone);
        imageUser = (ImageView) findViewById(R.id.userImage);

        currentUserId = FirebaseAuth.getInstance().getCurrentUser().getUid();

        historyRideInfoDb = FirebaseDatabase.getInstance().getReference().child("history").child(rideId);
        getRideInformation();






        mMapFragment = (SupportMapFragment) getSupportFragmentManager().findFragmentById(R.id.map);

        mMapFragment.getMapAsync(this);
    }

    private void getRideInformation() {
        historyRideInfoDb.addListenerForSingleValueEvent(new ValueEventListener() {
            @Override
            public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                if(dataSnapshot.exists()){
                    for(DataSnapshot child: dataSnapshot.getChildren()){
                        if(child.getKey().equals("customer")){
                            customerId = child.getValue().toString();
                            if(!customerId.equals(currentUserId)){
                                userDriverOrCustomer = "Drivers";
                                getUserInformation("Customers", customerId);
                            }
                        }
                        if(child.getKey().equals("driver")){
                            driverId = child.getValue().toString();
                            if(!driverId.equals(currentUserId)){
                                userDriverOrCustomer = "Customers";
                                getUserInformation("Drivers", driverId);
                            }
                        }
                        if(child.getKey().equals("timestamp")){
                            dateRide.setText(getDate(Long.valueOf(child.getValue().toString())));

                        }
                        if(child.getKey().equals("destination")){
                            locationRide.setText(child.getValue().toString());
                        }
                        if(child.getKey().equals("location")){
                            pickupLatLng = new LatLng(Double.valueOf(child.child("from").child("lat").getValue().toString()), Double.valueOf(child.child("from").child("lng").getValue().toString()));
                            destinationLatLng = new LatLng(Double.valueOf(child.child("to").child("lat").getValue().toString()), Double.valueOf(child.child("to").child("lng").getValue().toString()));
                            if(destinationLatLng != new LatLng(0,0)){
                                getRouteToMarker();
                            }
                        }
                    }
                }
            }

            @Override
            public void onCancelled(@NonNull DatabaseError databaseError) {

            }
        });
    }

    private void getUserInformation(String otherDriverOrCustomer, String otherUserId) {
        DatabaseReference mOtherUserDb = FirebaseDatabase.getInstance().getReference().child("Users").child(otherDriverOrCustomer).child(otherUserId);
        mOtherUserDb.addListenerForSingleValueEvent(new ValueEventListener() {
            @Override
            public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                if(dataSnapshot.exists()){
                    Map<String, Object> map = (Map<String, Object>) dataSnapshot.getValue();
                    if(map.get("name") != null){
                        nameUser.setText(map.get("name").toString());
                    }
                    if(map.get("phone") != null){
                        phoneUser.setText(map.get("phone").toString());
                    }
                    if(map.get("profileImageUrl") != null){
                        Glide.with(getApplication()).load(map.get("profileImageUrl").toString()).into(imageUser);
                    }

                }
            }

            @Override
            public void onCancelled(@NonNull DatabaseError databaseError) {

            }
        });
    }

    private String getDate(Long timestamp) {
        Calendar cal =  Calendar.getInstance(Locale.getDefault());
        cal.setTimeInMillis(timestamp*1000);
        String date = DateFormat.format("dd-MM-yyyy hh:mm", cal).toString();

        return date;
    }

    private void getRouteToMarker() {
        Routing routing = new Routing.Builder()
                .key("AIzaSyDZHVnHozuTEVrgOSHZ0JYoS7-Bf8Se4Mg")
                .travelMode(AbstractRouting.TravelMode.DRIVING)
                .withListener(this)
                .alternativeRoutes(false)
                .waypoints(pickupLatLng, destinationLatLng)
                .build();
        routing.execute();
    }

    @Override
    public void onMapReady(GoogleMap googleMap) {
        mMap = googleMap;
    }

    private List<Polyline> polylines;
    private static final int[] COLORS = new int[]{R.color.colorPrimary};


    @Override
    public void onRoutingFailure(RouteException e) {

        if(e != null) {
            Toast.makeText(this, "Error: " + e.getMessage(), Toast.LENGTH_LONG).show();
        }else {
            Toast.makeText(this, "Something went wrong, Try again", Toast.LENGTH_SHORT).show();
        }
    }

    @Override
    public void onRoutingStart() {

    }

    @Override
    public void onRoutingSuccess(ArrayList<Route> route, int shortestRouteIndex) {

        LatLngBounds.Builder builder = new LatLngBounds.Builder();
        builder.include(pickupLatLng);
        builder.include(destinationLatLng);
        LatLngBounds bounds = builder.build();

        int width = getResources().getDisplayMetrics().widthPixels;
        int padding  = (int) (width*0.2);

        CameraUpdate cameraUpdate = CameraUpdateFactory.newLatLngBounds(bounds, padding);

        mMap.animateCamera(cameraUpdate);
       // mMap.addMarker(new MarkerOptions().position(pickupLatLng).title("Pickup location").icon(BitmapDescriptorFactory.fromResource(R.mipmap.ic_flag)));
        mMap.addMarker(new MarkerOptions().position(destinationLatLng).title("Destination"));

        if(polylines.size()>0) {
            for (Polyline poly : polylines) {
                poly.remove();
            }
        }

        polylines = new ArrayList<>();
        //add route(s) to the map.
        for (int i = 0; i <route.size(); i++) {

            //In case of more than 5 alternative routes
            int colorIndex = i % COLORS.length;

            PolylineOptions polyOptions = new PolylineOptions();
            polyOptions.color(getResources().getColor(COLORS[colorIndex]));
            polyOptions.width(10 + i * 3);
            polyOptions.addAll(route.get(i).getPoints());
            Polyline polyline = mMap.addPolyline(polyOptions);
            polylines.add(polyline);

            Toast.makeText(getApplicationContext(),"Route "+ (i+1) +": distance - "+ route.get(i).getDistanceValue()+": duration - "+ route.get(i).getDurationValue(),Toast.LENGTH_SHORT).show();
        }


    }

    @Override
    public void onRoutingCancelled() {

    }

    private void erasePolyLines(){
        for(Polyline line : polylines){
            line.remove();
        }
        polylines.clear();
    }
}
