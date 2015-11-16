package com.example.salifu.hewalenurse.dummy;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

/**
 * Helper class for providing sample content for user interfaces created by
 * Android template wizards.
 * <p/>
 * TODO: Replace all uses of this class before publishing your app.
 */
public class DummyContent {

    /**
     * An array of sample (dummy) items.
     */
    public static List<DummyItem> ITEMS = new ArrayList<DummyItem>();

    /**
     * A map of sample (dummy) items, by ID.
     */
    public static Map<String, DummyItem> ITEM_MAP = new HashMap<String, DummyItem>();

    static {
        // Add 3 sample items.
        addItem(new DummyItem("1", "Talk about HIV in Ashesi"));
        addItem(new DummyItem("2", "Kill All mosquitoes in Nima"));
        addItem(new DummyItem("3", "Supply mosquito nets in Ashesi"));
        addItem(new DummyItem("3", "Stop ebola nicely"));
        addItem(new DummyItem("3", "Advice Nimanians to enjoy fufu"));
        addItem(new DummyItem("3", "Inject all Ashesi students"));
        addItem(new DummyItem("3", "Share mosquito nets in Ashiaman"));
        addItem(new DummyItem("3", "Save the planet"));
    }

    private static void addItem(DummyItem item) {
        ITEMS.add(item);
        ITEM_MAP.put(item.id, item);
    }

    /**
     * A dummy item representing a piece of content.
     */
    public static class DummyItem {
        public String id;
        public String content;

        public DummyItem(String id, String content) {
            this.id = id;
            this.content = content;
        }

        @Override
        public String toString() {
            return content;
        }
    }
}
