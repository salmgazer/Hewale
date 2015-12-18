package com.sourcey.materiallogindemo;

import android.support.v7.widget.RecyclerView;
import android.view.View;
import android.widget.TextView;

/**
 * Created by Salifu on 12/17/2015.
 */
public class CommentHolder extends RecyclerView.ViewHolder {

    View v;
    TextView message;
    TextView sent_by;

    CommentHolder(View itemView) {
        super(itemView);
        v = itemView.findViewById(R.id.single_comment);
        message = (TextView) itemView.findViewById(R.id.message);
        sent_by = (TextView) itemView.findViewById(R.id.sent_by);
    }
}
