### The approach
0. Use a framework 
1. As you want to check my coding style, then 1st step I want is to create the service for distance calculation. But usually if possible, I try to not reinvent the wheel, I found the library https://github.com/PhpUnitsOfMeasure/php-units-of-measure/tree/master/source . It handles the required calculation quite well, and if not the "we want to see how you code" requirement, I would use this library in this case.
2. Plug the service into the http server request handler layer
3. Add basic API validation
