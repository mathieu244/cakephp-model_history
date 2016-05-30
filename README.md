# cakephp-model_history
Keep a data history in an association field (If you don't wan't your data modified when in use by someone)

### Work in progress

- Add a field to keep history(by default I use "raw_product" (type TEXT)). By default I use "products" table, "product_id" as foreign key.
- Add HistoryBehavior and HistoryTrait to your project
- Add the behavior and trait use in your model/table. See "OrderProduct" as an example.

Now to get the association, always use saved_entity property.
- If no save's done, the property will return the association as usual.
- If a save's done, the property will return the same object structure with data saved in "raw_product" field

** Note that the data copy is done only one time to keep history of it over the time.
