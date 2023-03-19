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



}