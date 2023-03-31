<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Art.php';
class ArtRepository extends Repository
{
    private function getArtAvg($id_art)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT AVG(rate) FROM public.rates WHERE id_art = :id_art;
        ');
        $stmt->bindParam(':id_art', $id_art, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addArt(Art $art): void
    {
        $stmt = $this->database->connect()->prepare('
            CALL add_art(?, ?, ?, ?);
        ');

        $stmt->execute([
            $art->getName(),
            $art->getType(),
            $art->getCity(),
            $art->getImage()
        ]);
    }

    public function getArts(): array
    {
        $result = [];
        $stmt = $this->database->connect()->prepare('
            SELECT public.arts.*, public.cities.city, public.types.type, public.rates.rate
            FROM public.arts
            JOIN public.cities ON public.arts.id_city = public.cities.id_city
            JOIN public.types ON public.arts.id_type = public.types.id_type
            LEFT JOIN public.rates ON public.arts.id_art = public.rates.id_art AND public.rates.id_user = ?;
        ');
        $stmt->execute([
            $_COOKIE['id_user']
        ]);
        $arts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($arts as $art){
            $artObject = new Art(
                $art['type'],
                $art['name'],
                $art['city'],
                $art['image']
            );
            $artObject->setCurrentUserRate($art['rate']);
            $artObject->setId($art['id_art']);
            $artObject->setAvg($this->getArtAvg($artObject->getId()));
            $result[] = $artObject;
        }

        return $result;
    }


    public function getProjectByTitle(string $searchString)
    {
        $searchString = '%' . strtolower($searchString) . '%';

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.arts a
            JOIN public.cities c ON a.id_city = c.id_city
            JOIN public.types t ON a.id_type = t.id_type WHERE LOWER(type) LIKE :search OR LOWER(name) LIKE :search OR LOWER(city) LIKE :search;
        ');
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saveRate($rate, $id_art, $id_user)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.rates (id_user, id_art, rate) 
            VALUES (:id_user, :id_art, :rate);
        ');
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':id_art', $id_art, PDO::PARAM_INT);
        $stmt->bindParam(':rate', $rate, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getRateByUser($id_user, $id_art)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT rate FROM public.rates 
            WHERE id_art = :id_art AND id_user = :id_user;
        ');
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':id_art', $id_art, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}