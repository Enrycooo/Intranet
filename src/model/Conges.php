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
    public string $raison;
    public string $etat;
    public string $employe;
}

class Crud
{
    public int $id_conges;
    public string $date_debut;
    public string $date_fin;
    public string $duree;
    public string $commentaire;
    public string $raison;
    public string $etat;
    public string $employe;
    public string $debut_type;
    public string $fin_type;
}

class Conges_Model
{
        public DatabaseConnection $connection;
        
	public function createConge(int $id_employe, int $id_raison, string $date_debut, string $date_fin, string $debut_type, string $fin_type, string $duree, string $commentaire)
	{
                $stmt = $this->connection->getConnection()->prepare(
                "INSERT INTO conges(id_employe, id_raison, id_etat, date_debut, date_fin, debut_type, fin_type, duree, commentaire)
                VALUES(:id_employe, :id_raison, 2, :date_debut, :date_fin, :debut_type, :fin_type, :duree, :commentaire)"
                );
                
                $stmt->bindValue(':id_employe', $id_employe);
                $stmt->bindValue(':id_raison', $id_raison);
                $stmt->bindValue(':date_debut', $date_debut);
                $stmt->bindValue(':date_fin', $date_fin);
                $stmt->bindValue(':debut_type', $debut_type);
                $stmt->bindValue(':fin_type', $fin_type);
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
            $conge = new Conge();
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
        
        public function getCrudEnAttente(){
                $stmt= $this->connection->getConnection()->query("
                    SELECT id_conges, date_debut, date_fin, commentaire, duree, R.libelle AS raison, E.libelle AS etat, EM.nom, EM.prenom
                    FROM conges C INNER JOIN raison R ON C.id_raison=R.id_raison
                    INNER JOIN etat E ON C.id_etat = E.id_etat
                    INNER JOIN employe EM ON C.id_employe = EM.id_employe
                    WHERE C.id_etat = 2;
                    ");
                
                $cruds = [];
                while (($row = $stmt->fetch())) {
                    $date_debut = date("d-m-Y", strtotime($row['date_debut']));
                    $date_fin = date("d-m-Y", strtotime($row['date_fin']));
                    $crud = new Crud();
                    $crud->id_conges = $row['id_conges'];
                    $crud->date_debut = $date_debut;
                    $crud->date_fin = $date_fin;
                    $crud->commentaire = $row['commentaire'];
                    $crud->duree = $row['duree'];
                    $crud->raison = $row['raison'];
                    $crud->etat = $row['etat'];
                    $crud->nom = $row['nom'];
                    $crud->prenom = $row['prenom'];
                    
                    $cruds[] = $crud;
                }
                
                return $cruds;
        }
        
        public function getCrudConges(){
                $stmt= $this->connection->getConnection()->query("
                    SELECT id_conges, date_debut, date_fin, commentaire, duree, R.libelle AS raison, 
                    E.libelle AS etat, EM.nom, EM.prenom, C.debut_type, C.fin_type, C.id_raison, C.id_etat
                    FROM conges C INNER JOIN raison R ON C.id_raison=R.id_raison
                    INNER JOIN etat E ON C.id_etat = E.id_etat
                    INNER JOIN employe EM ON C.id_employe = EM.id_employe;
                    ");
                
                $cruds = [];
                while (($row = $stmt->fetch())) {
                    $date_debut = date("d-m-Y", strtotime($row['date_debut']));
                    $date_fin = date("d-m-Y", strtotime($row['date_fin']));
                    $crud = new Crud();
                    $crud->id_conges = $row['id_conges'];
                    $crud->date_debut = $date_debut;
                    $crud->date_fin = $date_fin;
                    $crud->commentaire = $row['commentaire'];
                    $crud->duree = $row['duree'];
                    $crud->raison = $row['raison'];
                    $crud->etat = $row['etat'];
                    $crud->nom = $row['nom'];
                    $crud->prenom = $row['prenom'];
                    $crud->debut_type = $row['debut_type'];
                    $crud->fin_type = $row['fin_type'];
                    $crud->id_raison = $row['id_raison'];
                    $crud->id_etat = $row['id_etat'];
                    
                    $cruds[] = $crud;
                }
                
                return $cruds;
        }
        
        public function deleteConges(int $id_conges){
            $stmt = $this->connection->getConnection()->prepare("DELETE FROM conges WHERE id_conges = :id_conges");
            $stmt->bindValue(':id_conges', $id_conges);
            $stmt->execute();
        }
        
        public function updateConges(int $id_conges, int $id_raison, int $id_etat, string $date_debut, string $date_fin, string $debut_type, string $fin_type, string $duree, string $commentaire){
            $stmt = $this->connection->getConnection()->prepare("UPDATE conges SET id_raison = :id_raison, id_etat = :id_etat, date_debut = :date_debut, date_fin = :date_fin, debut_type = :debut_type, 
                                                                fin_type = :fin_type, duree = :duree, commentaire = :commentaire
                                                                WHERE id_conges = :id_conges");
            $stmt->bindValue(':id_conges', $id_conges);
            $stmt->bindValue(':id_raison', $id_raison);
            $stmt->bindValue(':id_etat', $id_etat);
            $stmt->bindValue(':date_debut', $date_debut);
            $stmt->bindValue(':date_fin', $date_fin);
            $stmt->bindValue(':debut_type', $debut_type);
            $stmt->bindValue(':fin_type', $fin_type);
            $stmt->bindValue(':duree', $duree);
            $stmt->bindValue(':commentaire', $commentaire);
            $stmt->execute();
        }
}
