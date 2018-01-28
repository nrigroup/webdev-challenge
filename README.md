# NRI Web Development Challenge
Once you're done, please submit a paragraph or two in your `README` about what you are particularly proud of in your implementation, and why.

First of all, I'd like to thank NRI for giving me this opportunity. Laravel is a new framework for me, however I've had experience in the LAMP stack and developing MVC web apps. To me, Laravel seems very powerful and development was very intuitive. After reading through documentation, a lot of the API made development a lot easier.

I'm proud of my implementation of the front end design. I implemented a modern "drag and drop" feature to upload CSV files - with support for older browsers by allowing them to instead click to upload files. I'm also proud of my MVC implementation, the Model design in particular. I defined a Lot and LotSet as two different entities, where a LotSet can contain multiple Lots. Creation of a Lot was stored in a Trait. This was done so that both a Lot and LotTrait could create a Lot. This allows future development where a user may create individual lots instead of uploading a CSV set of them allowing code re-use.
I'm also proud of my web routes design. Assigning an ID to each LotSet allowed me to list LotSets in the history page. Users can then review LotSets they previously uploaded based on either the ID or date uploaded.

Once again, thanks NRI for the opportunity.

