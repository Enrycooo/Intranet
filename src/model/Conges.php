<?php
namespace Application\Model\Conges;

require_once('src/lib/database.php');

use Application\Lib\Database\DatabaseConnection;

class Conge
{
    public int $id_conges;
    public int $id_employe;
    public int $id_raison;
    public int $id_etat;
    public string $date_debut;
    public string $date_fin;
    public string $duree;
    public string $commentaire;
    public string $libelle;
}

class Conges_Model
{
        public DatabaseConnection $connection;
        
	public function createConge(int $id_employe, int $id_raison, string $date_debut, string $date_fin, string $duree, string $commentaire)
	{
                $stmt = $this->connection->getConnection()->prepare(
                "INSERT INTO conges(id_employe, id_raison, id_etat, date_debut, date_fin, duree, commentaire)
                VALUES(:id_employe, :id_raison, 2, :date_debut, :date_fin, :duree, :commentaire)"
                );
                $stmt->bindValue(':id_employe', $id_employe);
                $stmt->bindValue(':id_raison', $id_raison);
                $stmt->bindValue(':date_debut', $date_debut);
                $stmt->bindValue(':date_fin', $date_fin);
                $stmt->bindValue(':id_raison', $id_raison);
                $stmt->bindValue(':duree', $duree);
                $stmt->bindValue(':commentaire', $commentaire);
                $affectedLines = $stmt->execute();

                return ($affectedLines > 0);
	}
        
        public function getConges(): array {
            
                $stmt= $this->connection->getConnection()->query("SELECT id_conges, id_employe, 
                    DATE_FORMAT(date_debut, '%d/%m/%Y') AS date_debut, DATE_FORMAT(date_fin, '%d/%m/%Y') AS date_fin, etat, raison, duree
                    FROM conges");
                
                $conges = [];
                while (($row = $stmt->fetch())) {
                    $conge = new Conge();
                    $conge->id_conges = $row['id_conges'];
                    $conge->id_employe = $row['id_employe'];
                    $conge->date_debut = $row['date_debut'];
                    $conge->date_fin = $row['date_fin'];
                    $conge->etat = $row['etat'];
                    $conge->raison = $row['raison'];
                    $conge->duree = $row['duree'];

                    $conges[] = $conge;
                }

                return $conges;
        }
        
        public function getConge(int $id_conges){
            $stmt = $this->connection->getConnection()->prepare("SELECT * FROM conges WHERE id_conges = :id_conges");
            $stmt->bindValue(':id_conges', $id_conges);
            $stmt->execute();
            
            $row = $stmt->fetch();
            $conge = new Conges();
            $conge->id_conges = $row['id_conges'];
            $conge->id_employe = $row['id_employe'];
            $conge->date_debut = $row['date_debut'];
            $conge->date_fin = $row['date_fin'];
            $conge->etat = $row['etat'];
            $conge->raison = $row['raison'];
            $conge->duree = $row['duree'];
            
            return $conge;
        }
        
        public function getRaisons(){
            $stmt= $this->connection->getConnection()->query("SELECT id_raison, libelle FROM raison");
                
                $raisons = [];
                while (($row = $stmt->fetch())) {
                    $raison = new Conge();
                    $raison->id_raison = $row['id_raison'];
                    $raison->libelle = $row['libelle'];

                    $raisons[] = $raison;
                }

                return $raisons;
        }
		
}