<?php


require_once 'Repository.php';
require_once __DIR__.'/../models/Art.php';
class ArtRepository extends Repository
{
    public function getArt(int $id_art) : ?Art {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM arts WHERE id_art = :id_art
        ');
        $stmt->bindParam(':id_art', $id_art, PDO::PARAM_INT);
        $stmt->execute();

        $art = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$art) {
            return null;
        }

        return new Art(
            $art['type'],
            $art['name'],
            $art['city'],
            $art['image']
        );
    }

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


}