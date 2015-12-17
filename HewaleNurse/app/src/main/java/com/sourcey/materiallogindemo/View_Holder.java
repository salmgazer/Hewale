package com.sourcey.materiallogindemo;

import android.support.v7.widget.RecyclerView;
import android.view.View;
import android.widget.TextView;

/**
 * Created by Salifu on 12/6/2015.
 */
public class View_Holder extends RecyclerView.ViewHolder {

    View v;
    TextView summary;
    TextView starting_price;
    TextView date_added;
    TextView job_id;

    View_Holder(View itemView) {
        super(itemView);
        v = itemView.findViewById(R.id.single_job);
        summary = (TextView) itemView.findViewById(R.id.summary);
        starting_price = (TextView) itemView.findViewById(R.id.starting_price);
        date_added = (TextView) itemView.findViewById(R.id.date_added);
        //job_id = (TextView) itemView.findViewById(R.id.job_id);
    }
}