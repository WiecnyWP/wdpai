<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Art.php';
class ArtRepository extends Repository
{
    public function addArt(Art $art): void {
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

    public function getArts(): array {
        $result = [];
        $stmt = $this->database->connect()->prepare('
            SELECT *
            FROM public.arts a
            JOIN public.cities c ON a.id_city = c.id_city
            JOIN public.types t ON a.id_type = t.id_type;
        ');

        $stmt->execute();
        $arts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($arts as $art){
            $result[] = new Art(
                $art['type'],
                $art['name'],
                $art['city'],
                $art['image']
            );
        }

        return $result;
    }

    public function getProjectByTitle(string $searchString) {
        $searchString = '%' . strtolower($searchString) . '%';

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.arts a
            JOIN public.cities c ON a.id_city = c.id_city
            JOIN public.types t ON a.id_type = t.id_type WHERE LOWER(type) LIKE :search OR LOWER(name) LIKE :search OR LOWER(city) LIKE :search
        ');
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}