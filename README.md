### The approach
0. Use a framework 
1. As you want to check my coding style, then 1st step I want is to create the service for distance calculation. But usually if possible, I try to not reinvent the wheel, I found the library https://github.com/PhpUnitsOfMeasure/php-units-of-measure/tree/master/source . It handles the required calculation quite well, and if not the "we want to see how you code" obvious and understandable requirement, I would use this library in this case.
2. Plug the service into the http server request handler layer
3. Add basic API validation

### To launch
`$ docker-compose up`

And in the rest client request the resource:
`http://localhost:8080/api/distance/sum?targetUnit=m&query=3 Yards,5 Meters`

Example:
```
$ curl "http://localhost:8080/api/distance/sum?targetUnit=m&query=3 Yards,5 Meters"
=>  {"value":7.7432,"unit":"m"}
```

### Improvements
* now there's only just a very, very basic REST API validation, for sure there should be validation of:
  * passed units (allowed types)
  * passed values (digits)
* \App\Handler\CalculateDistanceHandler::convertQueryToDistances() is not as flexible/elastic as it should be and has
  some code smells
* Regarding the get param for distances instead of `query=3 Yards,5 Meters`, I should use 'get-array', for example:
`/api/distance/sum?targetUnit=m&value[]=3 Yards&value[]=5 Meters` - it would made validation and parsing query easier
* Also the REST API layer could be more user-client friendly in regards to unit and it's aliases (m/meter/meters, lower case, upper case, etc.) 
* \App\Service\DistanceCalculator\InMemoryCalculator now has two responsibilities: convertion of units and doing calculations (sum).
There could be separate interface UnitConverter and injected into InMemoryCalculator. Or InMemoryCalculator could be renamed to
SingleUnitCalculator (just for calculations) and decorated with MixedUnitCalculator(this class would be responsible for
 converting units to target one and then use injected SingleUnitCalculator to return the result)
* \App\Service\DistanceCalculator\Unit class could support not only SI short-units (m/yd), but also some aliases 
like: meter, meters, yard, yards, etc.
* \App\Handler\CalculateDistanceHandler - should be tested on the REST API layer and component layer.
As Calculator is unit tested, there's no need to double calculation tests
* Remove zendexpressive init "home page/ping" handlers
* Or if you have better/other ideas on improvements, then we could discuss them too:)
* And almost forgot - continuous integration and deployment could be added as well (gitlab-ci/jenkins/travis/etc.),
and if needed then dockerhub integration, docker swarm
