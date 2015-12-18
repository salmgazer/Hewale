package com.sourcey.materiallogindemo;

import android.support.v7.widget.RecyclerView;
import android.view.View;
import android.widget.TextView;

/**
 * Created by Salifu on 12/6/2015.
 */
public class View_Holder extends RecyclerView.ViewHolder {

    View v;
    TextView description;
    TextView end_time;
    TextView task_id;

    View_Holder(View itemView) {
        super(itemView);
        v = itemView.findViewById(R.id.single_task);
        description = (TextView) itemView.findViewById(R.id.description);
        end_time = (TextView) itemView.findViewById(R.id.end_time);
        task_id = (TextView) itemView.findViewById(R.id.task_id);
    }
}