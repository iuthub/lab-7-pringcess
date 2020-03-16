SELECT name
FROM movies
WHERE year =1995;

SELECT COUNT(actor_id) 
FROM roles
JOIN movies ON movie_id=movies.id
WHERE name ='Lost in Translation';

SELECT first_name, last_name
FROM (actors JOIN roles ON actors.id=actor_id)
JOIN movies ON roles.movie_id=movies.id
WHERE movies.name ='Lost in Translation';

SELECT first_name, last_name
FROM (movies JOIN movies_directors ON movies.id=movie_id)
JOIN directors ON director_id=directors.id
WHERE movies.name ='Lost in Translation';

SELECT COUNT(movie_id)
FROM movies_directors
JOIN directors ON director_id=directors.id
WHERE directors.first_name='Clint' AND directors.last_name='Eastwood';

SELECT name
FROM (movies JOIN movies_directors ON movies.id=movie_id)
JOIN directors ON director_id=directors.id
WHERE directors.first_name ='Clint' AND directors.last_name='Eastwood';

SELECT first_name, last_name
FROM directors
WHERE EXISTS (SELECT NULL
             FROM movies_genres
             JOIN movies_directors ON movies_genres.movie_id=movies_directors.movie_id
             WHERE genre='Horror');

SELECT DISTINCT actors.first_name, actors.last_name
FROM (actors JOIN roles ON actors.id=roles.actor_id)
JOIN movies_directors ON roles.movie_id=movies_directors.movie_id
JOIN directors ON movies_directors.director_id=directors.id
WHERE directors.first_name='Christopher' AND directors.last_name='Nolan';